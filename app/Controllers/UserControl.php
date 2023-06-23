<?php

namespace App\Controllers;

class UserControl extends BaseController
{
    public function viewDashboard()
    {
        $catWithSub = [];
        foreach ($this->cat->findAll() as $cd) {
            $sd = $this->sub->where('cid', $cd['cid'])->findAll();
            $catWithSub[] = ['category' => $cd, 'subjects' => $sd];
        }

        $data = [
            'catData' => $catWithSub,
            'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->orderBy('mdate', 'DESC')->where('mstatus', '1')->findAll(5),
            'blgData' => $this->blg->orderBy('bdate', 'DESC')->where('bstatus', '1')->findAll(5),
        ];

        $this->renderUserView('user/material/dashboard', $data);
    }

    public function viewBlogDashboard()
    {
        $data = [
            'blogpost' => $this->blg->orderBy('bid', 'RANDOM')->where('bstatus', '1')->findAll(4),
            'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->orderBy('mdate', 'DESC')->where('mstatus', '1')->findAll(5),
            'blgData' => $this->blg->orderBy('bdate', 'DESC')->where('bstatus', '1')->findAll(5),
        ];

        $this->renderUserView('user/blog/dashboard', $data);
    }
    
    public function viewSubject()
    {
        return $this->response->setJSON($this->sub->join('catagory', 'catagory.cid = subject.cid', 'right')->where('cslug', $this->request->getVar('cslug'))->find());
    }

    public function readMaterial($cslug, $sslug, $mslug)
    {
        $cd = $this->cat->where('cslug', $cslug)->first();
        $sd = $this->sub->where('sslug', $sslug)->first();

        if (!$cd || !$sd) {
            return redirect()->to(base_url('/'));
        }

        $md1 = $this->mat->where('cid', $cd['cid'])->where('sid', $sd['sid'])->where('mstatus', '1')->first();
        $md2 = $this->mat->where('mslug', $mslug)->where('mstatus', '1')->first();

        $md3 = [];
        $md5 = $this->mat->select('mdid')->where(['cid' => $cd['cid'], 'sid' => $sd['sid'], 'mstatus' => '1'])->distinct()->orderBy('mdid', 'ASC')->findAll();
        foreach ($md5 as $md) {
            $md6 = $this->mat->select('mid, mtitle, mslug')->where(['cid' => $cd['cid'], 'sid' => $sd['sid'], 'mdid' => $md['mdid'], 'mstatus' => '1'])->orderBy('mpos', 'ASC')->findAll();
            $md4 = ['mdname' => $this->mod->where('mdid', $md['mdid'])->first()['mdname']] + $md6;
            $md3[] = $md4;
        }

        $data = [
            'matData' => $md3,
            'catData' => $cd,
            'subData' => $sd,
            'fetchAllSub' => $this->sub->where(['cid' => $cd['cid'], 'sid !=' => $sd['sid']])->findAll(),
        ];

        $md = $mslug == 'first' ? $md1 : $md2;
        if ($md) {
            $data += [
                'artData' => $md,
                'pageHit' => $this->vst->where('page_type', 'm')->where('page_url', $md['mid'])->countAllResults(),
            ];

            $this->session->set('wtitle', $md['mtitle'] . ' | ');
        }

        $this->renderUserView('user/material/readMaterial', $data);
    }

    public function readBlogpost($bslug)
    {
        $bd = $this->blg->where('bslug', $bslug)->where('bstatus', '1')->first();
        $pageHit = $this->vst->where('page_type', 'b')->where('page_url', $bd['bid'])->countAllResults();

        $data = [
            'artData' => $bd,
            'pageHit' => $pageHit,
            'blgData' => $this->blg->orderBy('bdate', 'DESC')->where('bstatus', '1')->findAll(10),
        ];
        if ($bd) $this->session->set('wtitle', $bd['btitle'] . " | ");

        $this->renderUserView('user/blog/readBlogpost', $data);
    }

    public function exploreTopics()
    {
        return redirect()->to(base_url('/material/' . $this->request->getVar('mType') . '/' . $this->request->getVar('sType') . '/first'));
    }

    public function searchArticle($sTerm)
    {
        $sd = [];
        $md = $this->mat->like('mtitle', $sTerm)->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->where('mstatus', '1')->orderBy('mdate', 'desc')->findAll();
        $bd = $this->blg->like('btitle', $sTerm)->where('bstatus', '1')->orderBy('bdate', 'desc')->findAll();
        array_push($sd, $md, $bd);

        $data = [
            'searchData' => $sd,
            'matDataRand' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->where('mstatus', '1')->orderBy('mdate', 'RANDOM')->findAll(5),
            'blgDataRand' => $this->blg->where('bstatus', '1')->orderBy('bdate', 'RANDOM')->findAll(5),
        ];

        $this->renderUserView('user/searchArticle', $data);
    }

    public function contactAdmin($name, $email, $msg)
    {
        $this->send_mail($email, "Message from Bitasoft", "Your below message has been sent successfully.<br><br>Name: " . $name . "<br>Email: " . $email . "<br>Message: " . $msg);
        $this->send_mail("admin@bitasoft.in", "Message from Bitasoft", "Thanks for your Message.<br><br>Name: " . $name . "<br>Email: " . $email . "<br>Message: " . $msg);

        return redirect()->to(base_url('/#contact'));
    }

    public function send_mail($to, $sub, $body)
    {
        $this->email->setTo($to);
        $this->email->setFrom('no-reply@bitasoft.in', 'BitaSoft.in');
        $this->email->setReplyTo('admin@bitasoft.in', 'BitaSoft Admin');
        $this->email->setSubject($sub);
        $this->email->setMessage($body);
        $this->email->send();
    }

    public function logout()
    {
        $this->session->remove(['pcId', 'pOrgType', 'partnerLogged_in']);
        return redirect()->to(base_url('/'));
    }
}

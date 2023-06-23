<?php

namespace App\Controllers;

class AdminControl extends BaseController
{

    public function showAdminAuth()
    {
        return view('admin/auth');
    }

    public function validateAdminLogin()
    {
        if (!$this->validate(["aEmail" => ["label" => "Email", "rules" => "trim|required|valid_email"], "aPass" => ["label" => "Password", "rules" => "trim|required"]])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $aEmail = $this->request->getVar('aEmail');
            $aPass = $this->request->getVar('aPass');
            $data = $this->adm->where('aEmail', $aEmail)->first();
            if ($data) {
                if (password_verify($aPass, $data['aPass'])) {
                    $this->session->set(['aEmail' => $data['aEmail'], 'aAccessType' => $data['aAccessType'], 'adminLogged_in' => TRUE]);
                    $response = ['type' => 1, 'url' => base_url('admin')];
                } else {
                    $response = ['type' => 0, 'msg' => 'Wrong Password Entered!'];
                }
            } else {
                $response = ['type' => 0, 'msg' => 'No User Exist with this Email!'];
            }
        }
        return $this->response->setJSON($response);
    }

    public function viewDashboard()
    {
        $data = [
            'matData' => $this->mat->orderBy('mdate', 'DESC')->findAll(5),
            'blgData' => $this->blg->orderBy('bdate', 'DESC')->findAll(5),
        ];
        $this->renderAdminView('admin/dashboard', $data);
    }


    // ====================== Material Control Start======================

    public function addCatagory()
    {
        if (!$this->validate(["cname" => ["label" => "Catagory Name", "rules" => "required"], "cimg" => ["label" => "Catagory Image", "rules" => "uploaded[cimg]|max_size[cimg,3072]|is_image[cimg]"], "cdesc" => ["label" => "Catagory Description", "rules" => "required"]])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $cname = $this->request->getVar('cname');
            $cslug = $this->slugify($cname);

            if ($this->cat->where('cslug', $cslug)->first()) {
                $response = ['type' => 0, 'msg' => 'This catagory already exist!'];
            } else {
                $data = [
                    'cname' => $cname,
                    'cslug' => $cslug,
                    'cdesc' => $this->request->getVar('cdesc'),
                ];

                $cimg =    $this->request->getFile('cimg');
                if ($cimg->isValid() && !$cimg->hasMoved()) {
                    $cimgNew = $cimg->getRandomName();
                    // $this->image->withFile($cimg)->fit(730, 383, 'center')->save(ROOTPATH . '/uploads/cimg/' . $new_cimg);
                    $this->image->withFile($cimg)->resize(730, 383, false, 'height')->save(ROOTPATH . '/uploads/cimg/' . $cimgNew);

                    $data += [
                        'cimg' => $cimgNew,
                    ];
                }

                $this->cat->save($data);
                $response = ['type' => 1, 'msg' => 'Catagory Added Successfully!'];
            }
        }

        return $this->response->setJSON($response);
    }

    public function viewCatagory()
    {
        $data = [
            'catagory' => $this->cat->orderBy('cpos', 'ASC')->find(),
            'page' => 'catagory',
        ];

        $this->renderAdminView('admin/material/viewCatagory', $data);
    }

    public function viewUpdateCatagory()
    {
        return $this->response->setJSON($this->cat->where('cid', $this->request->getVar('cid'))->first());
    }

    public function updateCatagory()
    {
        if (!$this->validate(["cname" => ["label" => "Catagory Name", "rules" => "required"], "cimg" => ["label" => "Catagory Image", "rules" => "max_size[cimg,3072]|is_image[cimg]"], "cdesc" => ["label" => "Catagory Description", "rules" => "required"]])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $cid = $this->request->getVar('cid');
            $cname = $this->request->getVar('cname');
            $cslug = $this->slugify($cname);
            $cimg =    $this->request->getFile('cimg');
            $cdesc = $this->request->getVar('cdesc');

            $data = [
                'cname' => $cname,
                'cdesc' => $cdesc,
            ];

            $catData = $this->cat->where('cid', $cid)->first();
            if ($catData['cslug'] != $cslug) {
                $data += [
                    'cslug' => $cslug,
                ];
            }

            if ($cimg->isValid() && !$cimg->hasMoved()) {
                $cimgNew = $cimg->getRandomName();
                $this->image->withFile($cimg)->resize(730, 383, false, 'height')->save(ROOTPATH . '/uploads/cimg/' . $cimgNew);
                unlink(ROOTPATH . '/uploads/cimg/' . $catData['cimg']);

                $data += [
                    'cimg' => $cimgNew,
                ];
            }

            $this->cat->update($cid, $data);
            $response = ['type' => 1, 'msg' => 'Catagory Updated Successfully!'];
        }

        return $this->response->setJSON($response);
    }
    
    public function updateCatPosition()
    {
        $order  = explode(",", $this->request->getVar('order'));
        for ($i = 0; $i < count($order); $i++) {
            $this->cat->update($order[$i], ['cpos' => $i]);
        }
    }

    public function deleteCatagory()
    {
        $cid = $this->request->getVar('cid');
        $catData = $this->cat->where('cid', $cid)->first();
        unlink(ROOTPATH . '/uploads/cimg/' . $catData['cimg']);
        $this->cat->delete($cid);

        $response = ['type' => 1, 'msg' => 'Catagory Deleted Successfully!'];
        return $this->response->setJSON($response);
    }

    public function addSubject()
    {
        if (!$this->validate([
            "cid" => [
                "label" => "Catagory",
                "rules" => "required"
            ],
            "sname" => [
                "label" => "Subject Name",
                "rules" => "required"
            ],
        ])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $cid = $this->request->getVar('cid');
            $sname = $this->request->getVar('sname');
            $sslug = $this->slugify($sname);

            if ($this->sub->where(['cid' => $cid, 'sslug' => $sslug])->first()) {
                $response = ['type' => 0, 'msg' => 'This subject already exist!'];
            } else {
                $data = [
                    'cid' => $cid,
                    'sname' => $sname,
                    'sslug' => $sslug,
                ];

                $this->sub->save($data);
                $response = ['type' => 1, 'msg' => 'Subject Added Successfully!'];
            }
        }

        return $this->response->setJSON($response);
    }

    public function viewSubject()
    {
        return $this->response->setJSON($this->sub->where('cid', $this->request->getVar('cid'))->find());
    }

    public function updateSubject()
    {
        if (!$this->validate([
            "cid" => [
                "label" => "Catagory Id",
                "rules" => "required"
            ],
            "sid" => [
                "label" => "Subject Id",
                "rules" => "required"
            ],
            "sname" => [
                "label" => "Subject Name",
                "rules" => "required"
            ],
        ])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $cid = $this->request->getVar('cid');
            $sid = $this->request->getVar('sid');
            $sname = $this->request->getVar('sname');
            $sslug = $this->slugify($sname);

            if ($this->sub->where(['cid' => $cid, 'sslug' => $sslug])->first()) {
                $response = ['type' => 0, 'msg' => 'This subject already exist!'];
            } else {
                $data = [
                    'sname' => $sname,
                    'sslug' => $sslug,
                ];

                $this->sub->update($sid, $data);
                $response = ['type' => 1, 'msg' => 'Subject Updated Successfully!'];
            }
        }

        return $this->response->setJSON($response);
    }

    public function deleteSubject()
    {
        $this->sub->delete($this->request->getVar('sid'));

        $response = ['type' => 1, 'msg' => 'Subject Deleted Successfully!'];
        return $this->response->setJSON($response);
    }

    public function addModule()
    {
        if (!$this->validate([
            "sid" => [
                "label" => "Subject Id",
                "rules" => "required"
            ],
            "mdname" => [
                "label" => "Module Name",
                "rules" => "required"
            ],
        ])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $sid = $this->request->getVar('sid');
            $mdname = $this->request->getVar('mdname');
            $mdslug = $this->slugify($mdname);

            if ($this->mod->where(['sid' => $sid, 'mdslug' => $mdslug])->first()) {
                $response = ['type' => 0, 'msg' => 'This module already exist!'];
            } else {
                $data = [
                    'sid' => $sid,
                    'mdname' => $mdname,
                    'mdslug' => $mdslug,
                ];

                $this->mod->save($data);
                $response = ['type' => 1, 'msg' => 'Module Added Successfully!'];
            }
        }

        return $this->response->setJSON($response);
    }

    public function viewModule()
    {
        return $this->response->setJSON($this->mod->where(['sid' => $this->request->getVar('sid')])->find());
    }

    public function updateModule()
    {
        if (!$this->validate([
            "sid" => [
                "label" => "Subject Id",
                "rules" => "required"
            ],
            "mdid" => [
                "label" => "Module Id",
                "rules" => "required"
            ],
            "mdname" => [
                "label" => "Module Name",
                "rules" => "required"
            ],
        ])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $sid = $this->request->getVar('sid');
            $mdid = $this->request->getVar('mdid');
            $mdname = $this->request->getVar('mdname');
            $mdslug = $this->slugify($mdname);

            if ($this->mod->where(['sid' => $sid, 'mdslug' => $mdslug])->first()) {
                $response = ['type' => 0, 'msg' => 'This module already exist!'];
            } else {
                $data = [
                    'mdname' => $mdname,
                    'mdslug' => $mdslug,
                ];

                $this->mod->update($mdid, $data);
                $response = ['type' => 1, 'msg' => 'Module Updated Successfully!'];
            }
        }

        return $this->response->setJSON($response);
    }

    public function deleteModule()
    {
        $this->mod->delete($this->request->getVar('mdid'));

        $response = ['type' => 1, 'msg' => 'Module Deleted Successfully!'];
        return $this->response->setJSON($response);
    }

    public function viewAllMaterial()
    {
        $plim = $this->request->getVar('plim') ? $this->request->getVar('plim') : 10;

        $data = [
            'pubMatCount' => $this->mat->where('mstatus', '1')->countAllResults(),
            'unpubMatCount' => $this->mat->where('mstatus', '0')->countAllResults(),
        ];

        if ($this->request->getVar('type') == 'published') {
            $data += [
                'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('mstatus', '1')->orderBy('mdate', 'desc')->paginate($plim),

                'countMatData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('mstatus', '1')->countAllResults(),
            ];
        } else if ($this->request->getVar('type') == 'unpublished') {
            $data += [
                'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('mstatus', '0')->orderBy('mdate', 'desc')->paginate($plim),

                'countMatData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('mstatus', '0')->countAllResults(),
            ];
        } else if ($this->request->getVar('cid') && $this->request->getVar('sid') && $this->request->getVar('mdid')) {
            $data += [
                'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('material.cid', $this->request->getVar('cid'))->where('material.sid', $this->request->getVar('sid'))->where('material.mdid', $this->request->getVar('mdid'))->paginate($plim),

                'countMatData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('material.cid', $this->request->getVar('cid'))->where('material.sid', $this->request->getVar('sid'))->where('material.mdid', $this->request->getVar('mdid'))->countAllResults(),
            ];
        } else if ($this->request->getVar('cid') && $this->request->getVar('sid')) {
            $data += [
                'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('material.cid', $this->request->getVar('cid'))->where('material.sid', $this->request->getVar('sid'))->paginate($plim),

                'countMatData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('material.cid', $this->request->getVar('cid'))->where('material.sid', $this->request->getVar('sid'))->countAllResults(),
            ];
        } else if ($this->request->getVar('cid')) {
            $data += [
                'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('material.cid', $this->request->getVar('cid'))->paginate($plim),

                'countMatData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('material.cid', $this->request->getVar('cid'))->countAllResults(),
            ];
        } else if ($this->request->getVar('sid')) {
            $data += [
                'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('material.sid', $this->request->getVar('sid'))->paginate($plim),

                'countMatData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('material.sid', $this->request->getVar('sid'))->countAllResults(),
            ];
        } else {
            $data += [
                'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->orderBy('mdate', 'DESC')->paginate($plim),

                'countMatData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->countAllResults(),
            ];
        }

        $data += [
            'pager' => $this->mat->pager,
            'plim' => $plim,
        ];

        $this->renderAdminView('admin/material/viewAllMaterial', $data);
    }
    
    public function arrangeMaterialPos()
    {
        $cid = $this->request->getVar('cid');
        $sid = $this->request->getVar('sid');
        $mdid = $this->request->getVar('mdid');

        $plim = $this->request->getVar('plim') ? $this->request->getVar('plim') : 10;
        if ($cid && $sid && $mdid) {
            $data = [
                'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('material.cid', $cid)->where('material.sid', $sid)->where('material.mdid', $mdid)->orderBy('mpos')->paginate($plim),

                'countMatData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('material.cid', $cid)->where('material.sid', $sid)->where('material.mdid', $mdid)->countAllResults(),
            ];
        } else {
            return redirect()->route('admin/material');
        }

        $data += [
            'pager' => $this->mat->pager,
            'plim' => $plim,
        ];

        $this->renderAdminView('admin/material/arrangeMaterial', $data);
    }

    public function viewAddMaterial()
    {
        $this->renderAdminView('admin/material/addMaterial', []);
    }

    public function addMaterial()
    {
        if (!$this->validate(["mtitle" => ["label" => "Article Title", "rules" => "required"], "mfile" => ["label" => "Article File", "rules" => "max_size[mfile,3072]|ext_in[mfile,jpg,jpeg,png,webp,pdf]"], "mdesc" => ["label" => "Article Description", "rules" => "required"], "cid" => ["label" => "Article Catagory", "rules" => "required"], "sid" => ["label" => "Article Subject", "rules" => "required"], "mdid" => ["label" => "Article Module", "rules" => "required"], "mstatus" => ["label" => "Article Status", "rules" => "required"]])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $mtitle = $this->request->getVar('mtitle');
            $mslug = $this->slugify($mtitle);
            $mdesc = $this->request->getVar('mdesc');
            $cid = $this->request->getVar('cid');
            $sid = $this->request->getVar('sid');
            $mdid = $this->request->getVar('mdid');
            $mstatus = $this->request->getVar('mstatus');

            if ($this->mat->where('mslug', $mslug)->first()) {
                $response = ['type' => 0, 'msg' => 'This article already exist!'];
            } else {
                $maxpos = $this->mat->selectMax('mpos')->where(['cid' => $cid, 'sid' => $sid])->first();
                $data = [
                    'mtitle' => $mtitle,
                    'mslug' => $mslug,
                    'mdesc' => $mdesc,
                    'cid' => $cid,
                    'sid' => $sid,
                    'mdid' => $mdid,
                    'mstatus' => $mstatus,
                    'mpos' => $maxpos['mpos'] + 1,
                ];

                $mfile =    $this->request->getFile('mfile');
                if ($mfile->isValid() && !$mfile->hasMoved()) {
                    $mfileNew = $mfile->getRandomName();

                    $mfile->guessExtension() == 'pdf' ? $mfile->move(ROOTPATH . '/uploads/mfile/mdoc', $mfileNew) : $mfile->move(ROOTPATH . '/uploads/mfile/mimg', $mfileNew);

                    $data += [
                        'mfile' => $mfileNew,
                    ];
                }

                $this->mat->save($data);
                $response = ['type' => 1, 'msg' => 'Material Added Successfully!'];
            }
        }

        return $this->response->setJSON($response);
    }

    public function readMaterial($mid)
    {
        $data = [
            'artData' => $this->mat->where('mid', $mid)->first(),
            'material' => $this->mat->orderBy('mid', 'RANDOM')->findAll(7),
        ];

        if (!$data['artData']) return redirect()->to(base_url('admin'));

        $this->renderAdminView('admin/material/readMaterial', $data);
    }

    public function viewUpdateMaterial($mid)
    {
        $data = [
            'matData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->where('mid', $mid)->first(),
        ];

        if (!$data['matData']) return redirect()->to(base_url('admin'));

        $this->renderAdminView('admin/material/updateMaterial', $data);
    }

    public function updateMaterial()
    {
        if (!$this->validate(["mtitle" => ["label" => "Article Title", "rules" => "required"], "mfile" => ["label" => "Article File", "rules" => "max_size[mfile,3072]|ext_in[mfile,jpg,jpeg,png,webp,pdf]"], "mdesc" => ["label" => "Article Description", "rules" => "required"], "cid" => ["label" => "Article Catagory", "rules" => "required"], "sid" => ["label" => "Article Subject", "rules" => "required"], "mdid" => ["label" => "Article Module", "rules" => "required"], "mstatus" => ["label" => "Article Status", "rules" => "required"]])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $mid = $this->request->getVar('mid');
            $mtitle = $this->request->getVar('mtitle');
            $mslug = $this->slugify($mtitle);
            $mdesc = $this->request->getVar('mdesc');
            $cid = $this->request->getVar('cid');
            $sid = $this->request->getVar('sid');
            $mdid = $this->request->getVar('mdid');
            $mstatus = $this->request->getVar('mstatus');

            $data = [
                'mtitle' => $mtitle,
                'mdesc' => $mdesc,
                'cid' => $cid,
                'sid' => $sid,
                'mdid' => $mdid,
                'mstatus' => $mstatus,
            ];

            $md = $this->mat->where('mid', $mid)->first();
            if ($md['mslug'] != $mslug) {
                $data += [
                    'mslug' => $mslug,
                ];
            }

            $mfile =    $this->request->getFile('mfile');
            if ($mfile->isValid() && !$mfile->hasMoved()) {
                $mfileNew = $mfile->getRandomName();

                $mfile->guessExtension() == 'pdf' ? $mfile->move(ROOTPATH . '/uploads/mfile/mdoc', $mfileNew) : $mfile->move(ROOTPATH . '/uploads/mfile/mimg', $mfileNew);

                if ($md['mfile']) strpos(strtolower($md['mfile']), 'pdf') ? unlink(ROOTPATH . '/uploads/mfile/mdoc/' . $md['mfile']) : unlink(ROOTPATH . '/uploads/mfile/mimg/' . $md['mfile']);

                $data += [
                    'mfile' => $mfileNew,
                ];
            }

            $this->mat->update($mid, $data);
            $response = ['type' => 1, 'msg' => 'Material Updated Successfully!'];
        }

        return $this->response->setJSON($response);
    }
    
    public function updateMatPosition()
    {
        $order  = explode(",", $this->request->getVar('order'));
        for ($i = 0; $i < count($order); $i++) {
            $this->mat->update($order[$i], ['mpos' => $i]);
        }
    }

    public function removeMatFile()
    {
        $mid = $this->request->getVar('mid');
        $md = $this->mat->where('mid', $mid)->first();

        if ($md['mfile']) strpos(strtolower($md['mfile']), 'pdf') ? unlink(ROOTPATH . '/uploads/mfile/mdoc/' . $md['mfile']) : unlink(ROOTPATH . '/uploads/mfile/mimg/' . $md['mfile']);

        $this->mat->update($mid, ['mfile' => NULL]);
        $response = ['type' => 1, 'msg' => 'Material File Removed Successfully!'];

        return $this->response->setJSON($response);
    }

    public function deleteMaterial()
    {
        $mid = $this->request->getVar('mid');
        $md = $this->mat->where('mid', $mid)->first();

        if ($md['mfile']) strpos(strtolower($md['mfile']), 'pdf') ? unlink(ROOTPATH . '/uploads/mfile/mdoc/' . $md['mfile']) : unlink(ROOTPATH . '/uploads/mfile/mimg/' . $md['mfile']);

        $this->mat->delete($mid);
        $response = ['type' => 1, 'msg' => 'Material Deleted Successfully!'];

        return $this->response->setJSON($response);
    }

    // ====================== Material Control End======================


    // ====================== Blog Control Start======================

    public function viewAllBlogpost()
    {
        $type = $this->request->getVar('type');

        $data = [
            'pubBlgCount' => $this->blg->where('bstatus', '1')->countAllResults(),
            'unpubBlgCount' => $this->blg->where('bstatus', '0')->countAllResults(),
        ];

        if ($type == 'published') {
            $data += [
                'blgData' => $this->blg->where('bstatus', '1')->orderBy('bdate', 'desc')->paginate(10),
                'pager' => $this->blg->pager,
            ];
        } else if ($type == 'unpublished') {
            $data += [
                'blgData' => $this->blg->where('bstatus', '0')->orderBy('bdate', 'desc')->paginate(10),
                'pager' => $this->blg->pager,
            ];
        } else {
            $data += [
                'blgData' => $this->blg->orderBy('bdate', 'desc')->paginate(10),
                'pager' => $this->blg->pager,
            ];
        }

        $this->renderAdminView('admin/blog/viewAllBlogpost', $data);
    }

    public function viewAddBlogpost()
    {
        $this->renderAdminView('admin/blog/addBlogpost', []);
    }

    public function addBlogpost()
    {
        if (!$this->validate(["btitle" => ["label" => "Blog Title", "rules" => "required"], "bimg" => ["label" => "Blog File", "rules" => "uploaded[bimg]|max_size[bimg,3072]|is_image[bimg]"], "bdesc" => ["label" => "Blog Description", "rules" => "required"], "bstatus" => ["label" => "Blog Status", "rules" => "required"]])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $btitle = $this->request->getVar('btitle');
            $bslug = $this->slugify($btitle);
            $bdesc = $this->request->getVar('bdesc');
            $bstatus = $this->request->getVar('bstatus');

            if ($this->blg->where('bslug', $bslug)->first()) {
                $response = ['type' => 0, 'msg' => 'This Blog already exist!'];
            } else {
                $data = [
                    'btitle' => $btitle,
                    'bslug' => $bslug,
                    'bdesc' => $bdesc,
                    'bstatus' => $bstatus,
                ];

                $bimg =    $this->request->getFile('bimg');
                if ($bimg->isValid() && !$bimg->hasMoved()) {
                    $bimgNew = $bimg->getRandomName();
                    $this->image->withFile($bimg)->resize(730, 450, false, 'height')->save(ROOTPATH . '/uploads/bimg/' . $bimgNew);

                    $data += [
                        'bimg' => $bimgNew,
                    ];
                }

                $this->blg->save($data);
                $response = ['type' => 1, 'msg' => 'Blog Added Successfully!'];
            }
        }

        return $this->response->setJSON($response);
    }

    public function readBlogpost($bid)
    {
        $data = [
            'artData' => $this->blg->where('bid', $bid)->first(),
            'blogpost' => $this->blg->orderBy('bid', 'RANDOM')->findAll(7),
        ];

        if (!$data['artData']) return redirect()->to(base_url('admin'));

        $this->renderAdminView('admin/blog/readBlogpost', $data);
    }

    public function viewUpdateBlogpost($bid)
    {
        $data = [
            'blgData' => $this->blg->where('bid', $bid)->first(),
        ];

        if (!$data['blgData']) return redirect()->to(base_url('admin'));

        $this->renderAdminView('admin/blog/updateBlogpost', $data);
    }

    public function updateBlogpost()
    {
        if (!$this->validate(["btitle" => ["label" => "Blog Title", "rules" => "required"], "bimg" => ["label" => "Blog File", "rules" => "max_size[bimg,3072]|is_image[bimg]"], "bdesc" => ["label" => "Blog Description", "rules" => "required"], "bstatus" => ["label" => "Blog Status", "rules" => "required"]])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $bid = $this->request->getVar('bid');
            $btitle = $this->request->getVar('btitle');
            $bslug = $this->slugify($btitle);
            $bdesc = $this->request->getVar('bdesc');
            $bstatus = $this->request->getVar('bstatus');

            $data = [
                'btitle' => $btitle,
                'bdesc' => $bdesc,
                'bstatus' => $bstatus,
            ];

            $bd = $this->blg->where('bid', $bid)->first();
            if ($bd['bslug'] != $bslug) {
                $data += [
                    'bslug' => $bslug,
                ];
            }

            $bimg =    $this->request->getFile('bimg');
            if ($bimg->isValid() && !$bimg->hasMoved()) {
                $bimgNew = $bimg->getRandomName();
                $this->image->withFile($bimg)->resize(730, 450, false, 'height')->save(ROOTPATH . '/uploads/bimg/' . $bimgNew);

                if ($bd['bimg']) unlink(ROOTPATH . '/uploads/bimg/' . $bd['bimg']);

                $data += [
                    'bimg' => $bimgNew,
                ];
            }

            $this->blg->update($bid, $data);
            $response = ['type' => 1, 'msg' => 'Blog Updated Successfully!'];
        }

        return $this->response->setJSON($response);
    }

    public function deleteBlogpost()
    {
        $bid = $this->request->getVar('bid');
        $bd = $this->blg->where('bid', $bid)->first();

        if ($bd['bimg']) unlink(ROOTPATH . '/uploads/bimg/' . $bd['bimg']);

        $this->blg->delete($bid);
        $response = ['type' => 1, 'msg' => 'Blog Deleted Successfully!'];

        return $this->response->setJSON($response);
    }

    // ====================== Blog Control End======================

    public function searchArticle($cType, $sTerm)
    {
        if ($cType == 'sm') {
            $data = [
                'srchMatData' => $this->mat->join('catagory', 'catagory.cid = material.cid', 'INNER')->join('subject', 'subject.sid = material.sid', 'INNER')->join('module', 'module.mdid = material.mdid', 'INNER')->like('mtitle', $sTerm)->orderBy('mdate', 'desc')->paginate(10),
                'pager' => $this->mat->pager,
            ];

            $this->renderAdminView('admin/material/searchMaterial', $data);
        } else if ($cType == 'bp') {
            $data = [
                'srchBlgData' => $this->blg->like('btitle', $sTerm)->orderBy('bdate', 'desc')->paginate(10),
                'pager' => $this->blg->pager,
            ];

            $this->renderAdminView('admin/blog/searchBlogpost', $data);
        } else {
            return redirect()->to(base_url('admin'));
        }
    }
    
    public function uploadArtImg()
    {
        if (!$this->validate(["file" => ["label" => "Article Image", "rules" => "max_size[file,3072]|is_image[file]"]])) {
            $response = ['message' => 'error', 'msg' => $this->validator->listErrors(),];
        } else {
            $artimg = $this->request->getFile('file');
            if ($artimg->isValid() && !$artimg->hasMoved()) {
                $artimgNew = $artimg->getRandomName();
                $artimg->move(ROOTPATH . '/uploads/artimg', $artimgNew);

                $response = ['message' => 'success', 'location' => 'uploads/artimg/' . $artimgNew];
            }
        }
        return $this->response->setJSON($response);
    }

    public function logout()
    {
        $this->session->remove(['aEmail', 'adminLogged_in']);
        return redirect()->to(base_url('admin/auth/'));
    }
}

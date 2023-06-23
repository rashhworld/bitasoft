<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// Auto load custom modal
use App\Models\Admin_Model;
use App\Models\Catagory_Model;
use App\Models\Subject_Model;
use App\Models\Module_Model;
use App\Models\Material_Model;
use App\Models\Blogpost_Model;
use App\Models\Visitors_Model;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['cookie', 'text'];

    /**
     * Constructor.
     */

    protected function renderUserView($view, $data)
    {
        $data += [
            'catagory' => $this->cat->notLike('cname', 'blog')->orderBy('cpos', 'ASC')->find(),
            'subject' => $this->sub->find(),
            'module' => $this->mod->find(),
        ];

        echo view('user/include/header', $data);
        echo view($view);
        echo view('user/include/footer');
        
        $this->countVisitors();
    }

    protected function renderAdminView($view, $data)
    {
        $data += [
            'catagory' => $this->cat->notLike('cname', 'blog')->find(),
            'subject' => $this->sub->find(),
            'module' => $this->mod->find(),
            'material' => $this->mat->find(),
            'blogpost' => $this->blg->find(),
        ];

        echo view('admin/include/header', $data);
        echo view($view);
        echo view('admin/include/footer');
    }
    
    protected function countVisitors()
    {
        $ip = $this->request->getIPAddress();
        $pgid = NULL;

        if ($seg1 = $this->request->uri->getSegment(1)) {
            if ($seg1 == 'material') {
                if ($mslug = $this->request->uri->getSegment(4)) {
                    $md = $this->mat->where('mslug', $mslug)->first();
                    if ($md) {
                        $pgid = $md['mid'];
                        $type = "m";
                    }
                }
            } else if ($seg1 == 'blog') {
                if ($bslug = $this->request->uri->getSegment(2)) {
                    $bd = $this->blg->where('bslug', $bslug)->first();
                    if ($bd) {
                        $pgid = $bd['bid'];
                        $type = "b";
                    }
                }
            }
        }

        if ($pgid && !$this->vst->where('ip_address', $ip)->where('page_url', $pgid)->first()) {
            $data = [
                'page_type' => $type,
                'page_url' => $pgid,
                'ip_address' => $ip,
            ];

            $this->vst->save($data);
        }
    }
    
    protected function slugify($text)
    {
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text);
        $text = preg_replace('/\s+/', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);

        return $text;
    }

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        
        $response->noCache();

        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->email = \Config\Services::email();
        $this->image = \Config\Services::image();
        $this->pager = \Config\Services::pager();

        $this->adm = new Admin_Model();
        $this->cat = new Catagory_Model();
        $this->sub = new Subject_Model();
        $this->mod = new Module_Model();
        $this->mat = new Material_Model();
        $this->blg = new Blogpost_Model();
        $this->vst = new Visitors_Model();

        $this->session->set('wtitle', "");
    }
}

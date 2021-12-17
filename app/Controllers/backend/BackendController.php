<?php

namespace App\Controllers\backend;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BackendController
 *
 * BackendController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BackendController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BackendController extends Controller
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
     * to all other controllers that extend BackendController.
     *
     * @var array
     */
    protected $helpers = ['array', 'text'];

    /**
     * The main data array for the views
     *
     * @var array
     */
    protected $data = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->homeModel = service('home');
        $this->circuitsModel = service('circuits');
        $this->organizersModel = service('organizers');
        $this->eventsModel = service('events');
        $this->newsModel = service('news');
        $this->contactsModel = service('contacts');

        // E.g.: $this->session = \Config\Services::session();

        $this->dropdowns = service('dropdownManager');
        $this->data['typesDropdown'] = $this->dropdowns->typesDropdown();
        $this->data['circuitsDropdown'] = $this->dropdowns->circuitsDropdown();
        $this->data['organizersDropdown'] = $this->dropdowns->organizersDropdown();
        $this->data['eventsDropdown'] = $this->dropdowns->eventsDropdown(true);
        $this->data['membersDropdown'] = $this->dropdowns->membersDropdown();

        $this->authorization = service('authorizationUsers');
        $this->data['currentUser'] = $this->authorization->isLoggedin();
    }

    public function sectionAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $action = $this->request->getPost('action');
            $view = $this->request->getPost('view');
            $controller = $this->request->getPost('controller');

            $rules = $this->{$controller . "Model"}->{"validation" . $action};

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                if($action == 'Image'):
                    if($this->request->getFile('sections_image') != ''):
                        if($imagefile = $this->request->getFile('sections_image')):
                            $filename = $this->{$controller . "Model"}->doUpload($imagefile, 'sections_image');
                            $posts['sections_image'] = $filename;
                        endif;
                    else:
                        $json = ['errors' => ['sections_image' => lang('backend/global.messages.imageRequired')], 
                                              'token' => $token, 'message' => lang('backend/global.messages.validateError')];
                        return $this->response->setJSON($json); die();
                    endif;
                endif;

                $json = $this->{$controller . "Model"}->sectionAction($posts);
                $json['token'] = $token;
                $this->data['section'] = $json['section']; 

                $json['output'] = view('backend/template/sections/' . $view, $this->data);
                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function removeSectionAttachement()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $id = $this->request->getPost('id');
            $controller = $this->request->getPost('controller');

            $json = $this->{$controller . "Model"}->removeSectionAttachement($id);
            $json['token'] = $token;
            $this->data['section'] = $json['section']; 

            $json['output'] = view('backend/template/sections/_image_view', $this->data);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }
}

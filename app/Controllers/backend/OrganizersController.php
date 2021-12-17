<?php

namespace App\Controllers\backend;

class OrganizersController extends BackendController
{
    public function __construct()
    {
        $this->data['controller'] = 'organizers';
    }
    
    public function index()
    {
        $this->data['section'] = $this->organizersModel->getSector(3);

        $this->data['action'] = 'index';
        return view('backend/organizers/index_view', $this->data);
    }

    public function showAll()
    {
        $this->data['action'] = 'showAll';
        return view('backend/organizers/show_all_view', $this->data);
    }

    public function showAllAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->organizersModel->searchFields : [];
            $searchIds = ($this->request->getPost('searchIds') == true) ? $this->organizersModel->searchIds : [];
            $searchDate = ($this->request->getPost('searchDate') == true) ? $this->organizersModel->searchDate : [];

            if( ! $this->validate(array_merge($searchFields, $searchIds, $searchDate))):

                $errors = array_replace_key(['searchFields.', 'searchIds.', 'searchDate.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('backend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->organizersModel->getData($this->data['posts']);

            $output = view('backend/organizers/partials/_show_all_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function add()
    {
        $this->data['action'] = 'add';
        return view('backend/organizers/add_view', $this->data);
    }

    public function addOutput()
    {
        if($this->request->isAJAX()):

            $output = view('backend/organizers/partials/_add_view', $this->data);
            $json = ['output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function addAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $uniqids = ($this->request->getPost('uniqid') == true) ? $this->request->getPost('uniqid') : false;

            $rules = $this->organizersModel->validationRules($uniqids);

            if( ! $this->validate($rules)):

                $errors = ($this->request->getFiles()) ? 
                          array_merge($this->request->getPost(), $this->request->getFiles()) : 
                          $this->request->getPost();

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:
                
                $posts = $this->request->getPost();

                //print_r($this->request->getFiles()); die();

                // Upload images
                if($imagefile = $this->request->getFiles()):
                    $filenames = $this->organizersModel->doUpload($imagefile);
                    $posts['filenames'] = $filenames;
                endif;

                $json = $this->organizersModel->add($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function edit(Int $id)
    {
        $this->data['organizer'] = $this->_getOrganizerOr404($id);

        $this->data['action'] = 'edit';
        return view('backend/organizers/edit_view', $this->data);
    }

    public function editOutput()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $organizer = $this->_getOrganizerOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $this->data['organizer'] = $organizer;
            $output = view('backend/organizers/partials/_edit_view', $this->data);

            $json = ['output' => $output, 'token' => $token];
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function editAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('organizers_id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getOrganizerOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $rules = $this->organizersModel->validationRules([]);

            if( ! $this->validate($rules)):
                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];
                
                return $this->response->setJSON($json); die();
            else:
                $posts = $this->request->getPost();
                
                $json = $this->organizersModel->edit($posts);
                $json['token'] = $token;
                $this->data['organizer'] = $json['organizer']; 
                unset($json['organizer']);

                $json['output'] = view('backend/organizers/partials/_edit_view', $this->data);
                return $this->response->setJSON($json); die();
            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(Int $id)
    {
        $this->data['organizer'] = $this->_getOrganizerOr404($id);

        $this->data['action'] = 'show';
        return view('backend/organizers/show_view', $this->data);
    }

    public function deleteAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('organizers_id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getOrganizerOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->organizersModel->delete($id);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function getCircuitsTypes()
    {
        if($this->request->isAJAX()):

            $this->data['uniqid'] = $this->request->getPost('uniqid');

            $json['output'] = view('backend/organizers/partials/_circuits_view', $this->data);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function removeCircuitsTypes()
    {
        if($this->request->isAJAX()):

            $json['result'] = true;
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function selectTypes()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('id');
            $this->data['uniqid'] = $this->request->getPost('uniqid');
            
            $output = $this->organizersModel->selectTypes($id);
            $json = ['output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    private function _getOrganizerOr404(Int $id)
    {
        $organizer = $this->organizersModel->getID($id);

        if(is_null($organizer)):
            if($this->request->isAJAX()):
                return false;
            else:
                throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('backend/global.messages.itemNotFound'));
            endif;
        else:
            return $organizer;
        endif;      
    }
}

<?php

namespace App\Controllers\backend;

class CircuitsController extends BackendController
{
    public function __construct()
    {
        $this->data['controller'] = 'circuits';
    }
    
    public function index()
    {
        $this->data['section'] = $this->circuitsModel->getSector(2);

        $this->data['action'] = 'index';
        return view('backend/circuits/index_view', $this->data);
    }

    public function showAll()
    {
        $this->data['action'] = 'showAll';
        return view('backend/circuits/show_all_view', $this->data);
    }

    public function showAllAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->circuitsModel->searchFields : [];
            $searchIds = ($this->request->getPost('searchIds') == true) ? $this->circuitsModel->searchIds : [];
            $searchDate = ($this->request->getPost('searchDate') == true) ? $this->circuitsModel->searchDate : [];

            if( ! $this->validate(array_merge($searchFields, $searchIds, $searchDate))):

                $errors = array_replace_key(['searchFields.', 'searchIds.', 'searchDate.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('backend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->circuitsModel->getData($this->data['posts']);

            $output = view('backend/circuits/partials/_show_all_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function add()
    {
        $this->data['action'] = 'add';
        return view('backend/circuits/add_view', $this->data);
    }

    public function addOutput()
    {
        if($this->request->isAJAX()):

            $output = view('backend/circuits/partials/_add_view', $this->data);
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

            $rules = $this->circuitsModel->validationRules($uniqids);

            if( ! $this->validate($rules)):

                // MA QUESTO SERVE?
                //$errors = ($this->request->getFiles()) ? 
                          //array_merge($this->request->getPost(), $this->request->getFiles()) : 
                          //$this->request->getPost();

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:
                
                $posts = $this->request->getPost();

                //print_r($this->request->getFiles()); die();

                // Upload images
                if($imagefile = $this->request->getFiles()):
                    $filenames = $this->circuitsModel->doUpload($imagefile);
                    $posts['filenames'] = $filenames;
                endif;

                $json = $this->circuitsModel->add($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function edit(Int $id)
    {
        $this->data['circuit'] = $this->_getCircuitOr404($id);

        $this->data['action'] = 'edit';
        return view('backend/circuits/edit_view', $this->data);
    }

    public function editOutput()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $circuit = $this->_getCircuitOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $this->data['circuit'] = $circuit;
            $output = view('backend/circuits/partials/_edit_view', $this->data);

            $json = ['output' => $output, 'token' => $token];
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function editAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('circuits_id');
            
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getCircuitOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $uniqids = ($this->request->getPost('uniqid') == true) ? $this->request->getPost('uniqid') : false;

            $rules = $this->circuitsModel->validationRules($uniqids);

            if( ! $this->validate($rules)):

                $errors = ($this->request->getFiles()) ? array_merge($this->request->getPost(), $this->request->getFiles()) : $this->request->getPost();

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];
                
                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                // Upload images
                if($imagefile = $this->request->getFiles()):
                    $filenames = $this->circuitsModel->doUpload($imagefile);
                    $posts['filenames'] = $filenames;
                endif;

                $json = $this->circuitsModel->edit($posts);
                $json['token'] = $token;
                $this->data['circuit'] = $json['circuit']; 
                unset($json['circuit']);

                $json['output'] = view('backend/circuits/partials/_edit_view', $this->data);
                return $this->response->setJSON($json); die();
                
            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(Int $id)
    {
        $this->data['circuit'] = $this->_getCircuitOr404($id);

        $this->data['action'] = 'show';
        return view('backend/circuits/show_view', $this->data);
    }

    public function deleteAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('circuits_id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getCircuitOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->circuitsModel->delete($id);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function getTypesServices()
    {
        if($this->request->isAJAX()):

            $this->data['uniqid'] = $this->request->getPost('uniqid');

            $json['output'] = view('backend/circuits/partials/_types_view', $this->data);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function removeTypesServices()
    {
        if($this->request->isAJAX()):

            $json['result'] = true;
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function selectServices()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('id');
            $this->data['uniqid'] = $this->request->getPost('uniqid');
            
            $this->data['services'] = $this->circuitsModel->selectServices($id);

            $json['output'] = view('backend/circuits/partials/_services_view', $this->data);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    private function _getCircuitOr404(Int $id)
    {
        $circuit = $this->circuitsModel->getID($id);

        if(is_null($circuit)):
            if($this->request->isAJAX()):
                return false;
            else:
                throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('backend/global.messages.itemNotFound'));
            endif;
        else:
            return $circuit;
        endif;      
    }
}

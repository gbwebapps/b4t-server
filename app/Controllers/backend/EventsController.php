<?php

namespace App\Controllers\backend;

class EventsController extends BackendController
{
    public function __construct()
    {
        $this->eventsModel = service('events');
        $this->data['controller'] = 'events';

        $this->data['slots'] = $this->eventsModel->getAttributes('events_slots', 'id, slot');
        $this->data['services'] = $this->eventsModel->getAttributes('events_services', 'id, service');
    }
    
    public function index()
    {
        $this->data['section'] = $this->eventsModel->getSector(4);

        $this->data['action'] = 'index';
        return view('backend/events/index_view', $this->data);
    }

    public function showAll()
    {
        $this->data['action'] = 'showAll';
        return view('backend/events/show_all_view', $this->data);
    }

    public function showAllAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->eventsModel->searchFields : [];
            $searchIds = ($this->request->getPost('searchIds') == true) ? $this->eventsModel->searchIds : [];
            $searchDate = ($this->request->getPost('searchDate') == true) ? $this->eventsModel->searchDate : [];

            if( ! $this->validate(array_merge($searchFields, $searchIds, $searchDate))):

                $errors = array_replace_key(['searchFields.', 'searchIds.', 'searchDate.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('backend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->eventsModel->getData($this->data['posts']);

            $output = view('backend/events/partials/_show_all_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function add()
    {
        $this->data['action'] = 'add';
        return view('backend/events/add_view', $this->data);
    }

    public function addOutput()
    {
        if($this->request->isAJAX()):

            $output = view('backend/events/partials/_add_view', $this->data);
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
            $subUniqids = ($this->request->getPost('subUniqid') == true) ? $this->request->getPost('subUniqid') : false;

            $rules = $this->eventsModel->validationRules($uniqids, $subUniqids);

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
                    $filenames = $this->eventsModel->doUpload($imagefile);
                    $posts['filenames'] = $filenames;
                endif;

                $json = $this->eventsModel->add($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function edit(Int $id)
    {
        $this->data['event'] = $this->_getEventOr404($id);

        $this->data['action'] = 'edit';
        return view('backend/events/edit_view', $this->data);
    }

    public function editOutput()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $event = $this->_getEventOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $this->data['event'] = $event;
            $output = view('backend/events/partials/_edit_view', $this->data);

            $json = ['output' => $output, 'token' => $token];
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function editAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('events_id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getEventOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $rules = $this->eventsModel->validationRules;

            if( ! $this->validate($rules)):
                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];
                
                return $this->response->setJSON($json); die();
            else:
                $posts = $this->request->getPost();
                
                $json = $this->eventsModel->edit($posts);
                $json['token'] = $token;
                $this->data['event'] = $json['event']; 
                unset($json['event']);

                $json['output'] = view('backend/events/partials/_edit_view', $this->data);
                return $this->response->setJSON($json); die();
            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(Int $id)
    {
        $this->data['event'] = $this->_getEventOr404($id);

        $this->data['action'] = 'show';
        return view('backend/events/show_view', $this->data);
    }

    public function deleteAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('events_id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getEventOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->eventsModel->delete($id);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function selectOrganizer()
    {
        if($this->request->isAJAX()):

            $organizer_id = $this->request->getPost('organizer_id');

            $output = $this->eventsModel->selectOrganizer($organizer_id);
            $json = ['output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function selectCircuit()
    {
        if($this->request->isAJAX()):

            $organizer_id = $this->request->getPost('organizer_id');
            $circuit_id = $this->request->getPost('circuit_id');

            $output = $this->eventsModel->selectCircuit($organizer_id, $circuit_id);
            $json = ['output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function getDatesSlots()
    {
        if($this->request->isAJAX()):

            $this->data['uniqid'] = $this->request->getPost('uniqid');

            $json['output'] = view('backend/events/partials/_dates_slots_view', $this->data);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function removeDatesSlots()
    {
        if($this->request->isAJAX()):

            $json['result'] = true;
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function getServices()
    {
        if($this->request->isAJAX()):

            $this->data['subUniqid'] = $this->request->getPost('subUniqid');

            $json['output'] = view('backend/events/partials/_services_view', $this->data);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function removeServices()
    {
        if($this->request->isAJAX()):

            $json['result'] = true;
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function statusAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('events_id');
            $events_status = $this->request->getPost('events_status');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getEventOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->eventsModel->statusAction($id, $events_status);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    private function _getEventOr404(Int $id)
    {
        $event = $this->eventsModel->getID($id);

        if(is_null($event)):
            if($this->request->isAJAX()):
                return false;
            else:
                throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('backend/global.messages.itemNotFound'));
            endif;
        else:
            return $event;
        endif;      
    }
}

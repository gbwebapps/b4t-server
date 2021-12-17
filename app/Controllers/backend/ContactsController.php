<?php

namespace App\Controllers\backend;

class ContactsController extends BackendController
{
    public function __construct()
    {
        $this->data['controller'] = 'contacts';
    }

    public function index()
    {
        $this->data['section'] = $this->contactsModel->getSector(6);

        $this->data['action'] = 'index';
        return view('backend/contacts/index_view', $this->data);
    }

    public function showAll()
    {
        $this->data['action'] = 'showAll';
        return view('backend/contacts/show_all_view', $this->data);
    }

    public function showAllAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->contactsModel->searchFields : [];
            $searchIds = ($this->request->getPost('searchIds') == true) ? $this->contactsModel->searchIds : [];
            $searchDate = ($this->request->getPost('searchDate') == true) ? $this->contactsModel->searchDate : [];

            if( ! $this->validate(array_merge($searchFields, $searchIds, $searchDate))):

                $errors = array_replace_key(['searchFields.', 'searchIds.', 'searchDate.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('backend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->contactsModel->getData($this->data['posts']);

            $output = view('backend/contacts/partials/_show_all_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(Int $id)
    {
        $this->data['contact'] = $this->_getContactOr404($id);

        $this->data['action'] = 'show';
        return view('backend/contacts/show_view', $this->data);
    }

    public function deleteAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('contacts_id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getContactOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->contactsModel->delete($id);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    private function _getContactOr404(Int $id)
    {
        $contact = $this->contactsModel->getID($id);

        if(is_null($contact)):
            if($this->request->isAJAX()):
                return false;
            else:
                throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('backend/global.messages.itemNotFound'));
            endif;
        else:
            return $contact;
        endif;      
    }

}

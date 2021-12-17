<?php

namespace App\Controllers\backend;

use App\Models\backend\MembersModel;

class MembersController extends BackendController
{
    private $membersModel;

    public function __construct()
    {
        $this->membersModel = New MembersModel;
        $this->data['controller'] = 'members';
    }

    public function showAll()
    {
        $this->data['action'] = 'showAll';
        return view('backend/members/show_all_view', $this->data);
    }

    public function showAllAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->membersModel->searchFields : [];
            $searchIds = ($this->request->getPost('searchIds') == true) ? $this->membersModel->searchIds : [];
            $searchDate = ($this->request->getPost('searchDate') == true) ? $this->membersModel->searchDate : [];

            if( ! $this->validate(array_merge($searchFields, $searchIds, $searchDate))):

                $errors = array_replace_key(['searchFields.', 'searchIds.', 'searchDate.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('backend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->membersModel->getData($this->data['posts'], $this->data['currentUser']);

            $output = view('backend/members/partials/_show_all_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(Int $id)
    {
        $this->data['member'] = $this->_getMemberOr404($id);

        $this->data['action'] = 'show';
        return view('backend/members/show_view', $this->data);
    }

    public function deleteAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('members_id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getMemberOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->membersModel->delete($id);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function statusAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('members_id');
            $members_status = $this->request->getPost('members_status');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getMemberOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->membersModel->statusAction($id, $members_status);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    private function _getMemberOr404(Int $id)
    {
        $member = $this->membersModel->getID($id);

        if(is_null($member)):
            if($this->request->isAJAX()):
                return false;
            else:
                throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('backend/global.messages.itemNotFound'));
            endif;
        else:
            return $member;
        endif;      
    }
}

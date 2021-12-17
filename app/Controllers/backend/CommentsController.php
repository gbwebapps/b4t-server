<?php

namespace App\Controllers\backend;

use App\Models\backend\CommentsModel;

class CommentsController extends BackendController
{
    private $commentsModel;

    public function __construct()
    {
        $this->commentsModel = New CommentsModel;
        $this->data['controller'] = 'comments';
    }

    public function showAll()
    {
        $this->data['action'] = 'showAll';
        return view('backend/comments/show_all_view', $this->data);
    }

    public function showAllAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->commentsModel->searchFields : [];
            $searchIds = ($this->request->getPost('searchIds') == true) ? $this->commentsModel->searchIds : [];
            $searchDate = ($this->request->getPost('searchDate') == true) ? $this->commentsModel->searchDate : [];

            if( ! $this->validate(array_merge($searchFields, $searchIds, $searchDate))):

                $errors = array_replace_key(['searchFields.', 'searchIds.', 'searchDate.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('backend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->commentsModel->getData($this->data['posts']);

            $output = view('backend/comments/partials/_show_all_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function add()
    {
        $this->data['action'] = 'add';
        return view('backend/comments/add_view', $this->data);
    }

    public function addOutput()
    {
        if($this->request->isAJAX()):

            $output = view('backend/comments/partials/_add_view', $this->data);
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

            $rules = $this->commentsModel->validationRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:
                
                $posts = $this->request->getPost();

                $json = $this->commentsModel->add($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function edit(Int $id)
    {
        $this->data['comment'] = $this->_getCommentsOr404($id);

        $this->data['action'] = 'edit';
        return view('backend/comments/edit_view', $this->data);
    }

    public function editOutput()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $comments = $this->_getCommentsOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $this->data['comment'] = $comments;
            $output = view('backend/comments/partials/_edit_view', $this->data);

            $json = ['output' => $output, 'token' => $token];
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function editAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('comments_id');
            
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getCommentsOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $rules = $this->commentsModel->validationRules;

            if( ! $this->validate($rules)):

                $errors = ($this->request->getFiles()) ? array_merge($this->request->getPost(), $this->request->getFiles()) : $this->request->getPost();

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];
                
                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->commentsModel->edit($posts);
                $json['token'] = $token;
                $this->data['comment'] = $json['comment']; 
                unset($json['comment']);

                $json['output'] = view('backend/comments/partials/_edit_view', $this->data);
                return $this->response->setJSON($json); die();
                
            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(Int $id)
    {
        $this->data['comment'] = $this->_getCommentsOr404($id);

        $this->data['action'] = 'show';
        return view('backend/comments/show_view', $this->data);
    }

    public function deleteAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('comments_id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getCommentsOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->commentsModel->delete($id);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function statusAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('comments_id');
            $comments_status = $this->request->getPost('comments_status');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getCommentsOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->commentsModel->statusAction($id, $comments_status);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    private function _getCommentsOr404(Int $id)
    {
        $comments = $this->commentsModel->getID($id);

        if(is_null($comments)):
            if($this->request->isAJAX()):
                return false;
            else:
                throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('backend/global.messages.itemNotFound'));
            endif;
        else:
            return $comments;
        endif;      
    }
}

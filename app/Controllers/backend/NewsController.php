<?php

namespace App\Controllers\backend;

class NewsController extends BackendController
{
    public function __construct()
    {
        $this->data['controller'] = 'news';
    }

    public function index()
    {
        $this->data['section'] = $this->newsModel->getSector(5);

        $this->data['action'] = 'index';
        return view('backend/news/index_view', $this->data);
    }

    public function showAll()
    {
        $this->data['action'] = 'showAll';
        return view('backend/news/show_all_view', $this->data);
    }

    public function showAllAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->newsModel->searchFields : [];
            $searchIds = ($this->request->getPost('searchIds') == true) ? $this->newsModel->searchIds : [];
            $searchDate = ($this->request->getPost('searchDate') == true) ? $this->newsModel->searchDate : [];

            if( ! $this->validate(array_merge($searchFields, $searchIds, $searchDate))):

                $errors = array_replace_key(['searchFields.', 'searchIds.', 'searchDate.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('backend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->newsModel->getData($this->data['posts']);

            $output = view('backend/news/partials/_show_all_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function add()
    {
        $this->data['action'] = 'add';
        return view('backend/news/add_view', $this->data);
    }

    public function addOutput()
    {
        if($this->request->isAJAX()):

            $output = view('backend/news/partials/_add_view', $this->data);
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

            $rules = $this->newsModel->validationRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:
                
                $posts = $this->request->getPost();

                // Upload images
                if($imagefile = $this->request->getFiles()):
                    $filenames = $this->newsModel->doUpload($imagefile);
                    $posts['filenames'] = $filenames;
                endif;

                $json = $this->newsModel->add($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function edit(Int $id)
    {
        $this->data['news'] = $this->_getNewsOr404($id);

        $this->data['action'] = 'edit';
        return view('backend/news/edit_view', $this->data);
    }

    public function editOutput()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $news = $this->_getNewsOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $this->data['news'] = $news;
            $output = view('backend/news/partials/_edit_view', $this->data);

            $json = ['output' => $output, 'token' => $token];
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function editAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('news_id');
            
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getNewsOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $rules = $this->newsModel->validationRules;

            if( ! $this->validate($rules)):

                $errors = ($this->request->getFiles()) ? array_merge($this->request->getPost(), $this->request->getFiles()) : $this->request->getPost();

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];
                
                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                // Upload images
                if($imagefile = $this->request->getFiles()):
                    $filenames = $this->newsModel->doUpload($imagefile);
                    $posts['filenames'] = $filenames;
                endif;

                $json = $this->newsModel->edit($posts);
                $json['token'] = $token;
                $this->data['news'] = $json['news']; 
                unset($json['news']);

                $json['output'] = view('backend/news/partials/_edit_view', $this->data);
                return $this->response->setJSON($json); die();
                
            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(Int $id)
    {
        $this->data['news'] = $this->_getNewsOr404($id);

        $this->data['action'] = 'show';
        return view('backend/news/show_view', $this->data);
    }

    public function deleteAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('news_id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getNewsOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->newsModel->delete($id);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function inHomeAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('news_id');
            $in_home = $this->request->getPost('in_home');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getNewsOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->newsModel->inHomeAction($id, $in_home);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function statusAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('news_id');
            $news_status = $this->request->getPost('news_status');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getNewsOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->newsModel->statusAction($id, $news_status);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    private function _getNewsOr404(Int $id)
    {
        $news = $this->newsModel->getID($id);

        if(is_null($news)):
            if($this->request->isAJAX()):
                return false;
            else:
                throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('backend/global.messages.itemNotFound'));
            endif;
        else:
            return $news;
        endif;      
    }
}

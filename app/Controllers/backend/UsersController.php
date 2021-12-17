<?php

namespace App\Controllers\backend;

use App\Models\backend\UsersModel;

class UsersController extends BackendController
{
    private $usersModel;

    public function __construct()
    {
        $this->usersModel = New UsersModel;
        $this->data['controller'] = 'users';
    }

    public function showAll()
    {
        $this->data['action'] = 'showAll';
        return view('backend/users/show_all_view', $this->data);
    }

    public function showAllAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->usersModel->searchFields : [];
            $searchIds = ($this->request->getPost('searchIds') == true) ? $this->usersModel->searchIds : [];
            $searchDate = ($this->request->getPost('searchDate') == true) ? $this->usersModel->searchDate : [];

            if( ! $this->validate(array_merge($searchFields, $searchIds, $searchDate))):

                $errors = array_replace_key(['searchFields.', 'searchIds.', 'searchDate.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('backend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->usersModel->getData($this->data['posts'], $this->data['currentUser']);

            $output = view('backend/users/partials/_show_all_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function add()
    {
        $this->data['action'] = 'add';
        return view('backend/users/add_view', $this->data);
    }

    public function addOutput()
    {
        if($this->request->isAJAX()):

            $output = view('backend/users/partials/_add_view', $this->data);
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

            $rules = $this->usersModel->validationRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:
                
                $posts = $this->request->getPost();

                if($this->request->getFile('users_image') != ''):
                    if($imagefile = $this->request->getFile('users_image')):
                        $filename = $this->usersModel->doUpload($imagefile, 'users_image');
                        $posts['users_image'] = $filename;
                    endif;
                endif;

                $json = $this->usersModel->add($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function edit(Int $id)
    {
        $this->data['user'] = $this->_getUserOr404($id);

        $this->data['action'] = 'edit';
        return view('backend/users/edit_view', $this->data);
    }

    public function editOutput()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $user = $this->_getUserOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $this->data['user'] = $user;
            $output = view('backend/users/partials/_edit_view', $this->data);

            $json = ['output' => $output, 'token' => $token];
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function editAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('users_id');
            
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getUserOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $rules = $this->usersModel->validationRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];
                
                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                if($this->request->getFile('users_image') != ''):
                    if($imagefile = $this->request->getFile('users_image')):
                        $filename = $this->usersModel->doUpload($imagefile, 'users_image');
                        $posts['users_image'] = $filename;
                    endif;
                endif;

                $json = $this->usersModel->edit($posts);
                $json['token'] = $token;
                $this->data['user'] = $json['user']; 
                unset($json['user']);

                $json['output'] = view('backend/users/partials/_edit_view', $this->data);
                return $this->response->setJSON($json); die();
                
            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(Int $id)
    {
        $this->data['user'] = $this->_getUserOr404($id);

        $this->data['action'] = 'show';
        return view('backend/users/show_view', $this->data);
    }

    public function deleteAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('users_id');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getUserOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->usersModel->delete($id);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function account(String $id)
    {
        if( ! $this->data['user'] = $this->usersModel->getProfile($id)):
            // qui si può fare il redirect ad una pagina specifica di errore
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;

        $this->data['action'] = 'account';
        return view('backend/users/account_view', $this->data);
    }

    public function accountOutput()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('id');
            $token = csrf_hash();

            // die($id);

            // Check if it is existing...
            if( ! $user = $this->_getUserOr404(1)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $this->data['user'] = $user;
            $output = view('backend/users/partials/_account_view', $this->data);

            $json = ['output' => $output, 'token' => $token];
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function accountAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('users_id');
            
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getUserOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $rules = $this->usersModel->accountRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];
                
                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                if($this->request->getFile('users_image') != ''):
                    if($imagefile = $this->request->getFile('users_image')):
                        $filename = $this->usersModel->doUpload($imagefile, 'users_image');
                        $posts['users_image'] = $filename;
                    endif;
                endif;

                $json = $this->usersModel->edit($posts);
                $json['token'] = $token;
                $this->data['user'] = $json['user']; 
                $json['currentUser'] = $this->data['user']->users_firstname . ' ' . $this->data['user']->users_lastname;
                $json['avatarCurrentUser'] = '<img src="' . base_url('files/users/section/' . esc($this->data['user']->users_image)) . '" width="25" height="25" class="img-thumbnail">';
                unset($json['user']);

                $json['output'] = view('backend/users/partials/_account_view', $this->data);
                return $this->response->setJSON($json); die();
                
            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;       
    }

    public function statusAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('users_id');
            $users_status = $this->request->getPost('users_status');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getUserOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->usersModel->statusAction($id, $users_status);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function roleAction()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('users_id');
            $users_role = $this->request->getPost('users_role');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getUserOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->usersModel->roleAction($id, $users_role);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function removeAvatar()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('id');
            $view = $this->request->getPost('view');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getUserOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->usersModel->removeAvatar($id);
            $this->data['user'] = $json['user']; 

            if($view == 'account'):
                $json['avatarCurrentUser'] = '<i class="fas fa-user-tie"></i>';
            endif;

            $json['output'] = view('backend/users/partials/_' . $view . '_view', $this->data);
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function resetPassword()
    {
        if($this->request->isAJAX()):

            $id = $this->request->getPost('users_id');
            $view = $this->request->getPost('view');
            $token = csrf_hash();

            // Check if it is existing...
            if( ! $this->_getUserOr404($id)):
                $json = ['result' => 'not_found', 'token' => $token, 'message' => lang('backend/global.messages.itemNotFound')];
                return $this->response->setJSON($json); die();
            endif;

            $json = $this->usersModel->resetPassword($id);

            if($view == 'account'):
                $this->data['user'] = $this->data['currentUser']; 
                $json['output'] = view('backend/users/partials/_' . $view . '_view', $this->data);
            endif;

            $json['token'] = $token;
            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    private function _getUserOr404(Int $id)
    {
        $user = $this->usersModel->getID($id);

        if(is_null($user)):

            if($this->request->isAJAX()):
                return false; // qui posso restituire messaggio utente non trovato
            else:
                throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('backend/global.messages.itemNotFound'));
            endif;

        elseif($user->users_master == 1):

            if($this->request->isAJAX()):
                return false; // qui posso restituire messaggio utente master è protetto
            else:
                throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('backend/users.messages.protectingMaster'));
            endif;

        else:
            return $user;
        endif;      
    }
}

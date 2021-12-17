<?php

namespace App\Controllers\backend;

use App\Models\backend\AuthModel;

class AuthController extends BackendController
{
    private $authModel;

    public function __construct()
    {
        $this->authModel = New AuthModel;
        $this->data['controller'] = 'auth';
        $this->data['styles'] = ['auth'];
    }

    public function login()
    {
        $this->data['action'] = 'login';
        return view('backend/auth/login_view', $this->data);
    }

    public function loginAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $rules = $this->authModel->loginRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->authModel->login($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function recovery()
    {
       $this->data['action'] = 'recovery';
       return view('backend/auth/recovery_view', $this->data);
    }

    public function recoveryAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $rules = $this->authModel->recoveryRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->authModel->recovery($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function setPassword(String $token)
    {
        if($this->authModel->checkAuthCode($token)):

            $this->data['token'] = $token;

            $this->data['action'] = 'set_password';
            return view('backend/auth/set_password_view', $this->data);

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function setPasswordAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $rules = $this->authModel->setPasswordRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->authModel->setPassword($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function logout()
    {
        $cookie = $this->request->getCookie('users_remember_me');

        if($cookie):
            $this->authModel->logoutByCookie($cookie);
            return redirect()->to('admin/dashboard')->withCookies();
        else:
            $this->authModel->logoutBySession();
            return redirect()->to('admin/dashboard');
        endif;
    }
}

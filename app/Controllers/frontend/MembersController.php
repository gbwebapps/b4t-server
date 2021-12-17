<?php

namespace App\Controllers\frontend;

use App\Models\frontend\MembersModel;

class MembersController extends FrontendController
{
    private $membersModel;

    public function __construct()
    {
        $this->membersModel = New MembersModel;
        $this->data['controller'] = 'members';
    }
    
    public function index() // Pagina mai chiamata direttamente che funziona da landing per mostrare eventuali errori
    {
        $this->data['action'] = 'index';
        return view('frontend/members/index_view', $this->data);
    }

    /*
     * --------------------------------------------------------------------
     * Auth area
     * --------------------------------------------------------------------
     */

    public function login()
    {
        $this->data['title'] = 'Login';

        $this->data['action'] = 'login';
        return view('frontend/members/login_view', $this->data);
    }

    public function loginAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $rules = $this->membersModel->loginRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('frontend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->membersModel->login($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function recovery()
    {
        $this->data['title'] = 'Recovery';

        $this->data['action'] = 'recovery';
        return view('frontend/members/recovery_view', $this->data);
    }

    public function recoveryAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $rules = $this->membersModel->recoveryRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->membersModel->recovery($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function setPassword(String $token)
    {
        if($this->membersModel->checkAuthCode($token)):

            $this->data['token'] = $token;

            $this->data['title'] = 'Set password';

            $this->data['action'] = 'set_password';
            return view('frontend/members/set_password_view', $this->data);

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function setPasswordAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $rules = $this->membersModel->setPasswordRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('frontend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->membersModel->setPassword($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function register()
    {
        $this->data['title'] = 'Register';

        $this->data['action'] = 'register';
        return view('frontend/members/register_view', $this->data);
    }

    public function registerAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();
            $rules = $this->membersModel->registerRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('frontend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->membersModel->register($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    /*
     * --------------------------------------------------------------------
     * Reserved area
     * --------------------------------------------------------------------
     */

    public function dashboard()
    {
        $this->data['title'] = 'Dashboard';

        $this->data['action'] = 'dashboard';
        return view('frontend/members/dashboard_view', $this->data);
    }

    public function profile()
    {
        $this->data['title'] = 'Profile';

        $this->data['action'] = 'profile';
        return view('frontend/members/profile_view', $this->data);
    }

    public function profileAction() // Pagina AJAX per gestire il cambio dei dati del member
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function orders() // Pagina degli ordini effettuati dal member
    {
        $this->data['title'] = 'Orders';

        $this->data['action'] = 'orders';
        return view('frontend/members/orders_view', $this->data);
    }

    public function ordersAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function logout()
    {
        $cookie = $this->request->getCookie('members_remember_me');

        if($cookie):
            $this->membersModel->logoutByCookie($cookie);
            return redirect()->to('members/account/dashboard')->withCookies();
        else:
            $this->membersModel->logoutBySession();
            return redirect()->to('members/account/dashboard');
        endif;
    }

    private function _getMemberOr404($id)
    {
        $member = $this->membersModel->getID($id);

        if(is_null($member)):
            throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('frontend/Global.messages.itemNotFound'));
        else:
            return $member;
        endif;      
    }
}

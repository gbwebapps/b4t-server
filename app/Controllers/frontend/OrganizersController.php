<?php

namespace App\Controllers\frontend;

use App\Models\frontend\OrganizersModel;

class OrganizersController extends FrontendController
{
    private $organizersModel;

    public function __construct()
    {
        $this->organizersModel = New OrganizersModel;
        $this->data['controller'] = 'organizers';
    }

    public function index()
    {
        $this->data['section'] = $this->organizersModel->getSector(3);

        $this->data['action'] = 'index';
        return view('frontend/organizers/index_view', $this->data);
    }

    public function indexAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->organizersModel->searchFields : [];

            if( ! $this->validate($searchFields)):

                $errors = array_replace_key(['searchFields.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('frontend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $posts = $this->request->getPost();
            $this->data['data'] = $this->organizersModel->getData($posts);

            $output = view('frontend/organizers/partials/_index_action_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(String $slug)
    {
        $this->data['items'] = $this->_getOrganizerOr404($slug);
        $this->data['files'] = $this->organizersModel->getFiles($this->data['items']['record']->organizers_id);

        $this->data['action'] = 'show';
        return view('frontend/organizers/show_view', $this->data);
    }

    public function getSubAction()
    {
        if($this->request->isAJAX()):

            $subSearchFields = ($this->request->getPost('subSearchFields') == true) ? $this->organizersModel->subSearchFields : [];

            if( ! $this->validate($subSearchFields)):

                $errors = array_replace_key(['subSearchFields.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('frontend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $subPosts = $this->request->getPost();

            $this->data['subSection'] = $this->request->getPost('subSection');

            $this->data['data'] = $this->organizersModel->getSubAction($subPosts, $this->data['subSection'], 'organizer');

            $output = view('frontend/organizers/partials/_get_' . $this->data['subSection'] . '_action_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function getNewsAction() // Chiamata AJAX per recuperare tutti le news di un organizzatore, paginazione, ordinamento e ricerca avanzata.
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
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
        return view('frontend/organizers/login_view', $this->data);
    }

    public function loginAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $rules = $this->organizersModel->loginRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('frontend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->organizersModel->login($posts);
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
        return view('frontend/organizers/recovery_view', $this->data);
    }

    public function recoveryAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $rules = $this->organizersModel->recoveryRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->organizersModel->recovery($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function setPassword(String $token)
    {
        if($this->organizersModel->checkAuthCode($token)):

            $this->data['token'] = $token;

            $this->data['title'] = 'Set password';

            $this->data['action'] = 'set_password';
            return view('frontend/organizers/set_password_view', $this->data);

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function setPasswordAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();

            $rules = $this->organizersModel->setPasswordRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('frontend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->organizersModel->setPassword($posts);
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

    public function dashboard() // Pagina principale dell'dashboard con benvenuto
    {
        $this->data['title'] = 'Dashboard';

        $this->data['action'] = 'dashboard';
        return view('frontend/organizers/dashboard_view', $this->data);
    }

    public function profile() // Pagina di editing del profilo per cambiare i propri dati ed inserire nuova immagine o nuova password
    {
        $this->data['title'] = 'Profile';

        $this->data['action'] = 'profile';
        return view('frontend/organizers/profile_view', $this->data);
    }

    public function profileAction() // Pagina AJAX per gestire il cambio dei dati dell'organizzatore
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function events() // Pagina di visualizzazione di tutti gli eventi organizzati dall'organizzatore
    {
        $this->data['title'] = 'Events';

        $this->data['action'] = 'events';
        return view('frontend/organizers/events_view', $this->data);
    }

    public function eventsAction() // Pagina di gestione della lista degli eventi, paginazione, ordinamento e ricerca avanzata
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function eventsAdd() // Pagina form inserimento eventi
    {
        $this->data['title'] = 'Add Event';

        $this->data['action'] = 'add';
        return view('frontend/organizers/add_events_view', $this->data);
    }

    public function eventsAddOutput() // Chiamata AJAX reset form aggiungi eventi
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function eventsAddAction() // Chiamata AJAX per inserimento evento
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function eventsEdit($slug, $id) // Pagina form aggiornamento eventi
    {
        $this->data['title'] = 'Edit Event';

        $this->data['action'] = 'edit';
        return view('frontend/organizers/edit_events_view', $this->data);
    }

    public function eventsEditOutput() // Chiamata AJAX refresh form aggiorna eventi
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function eventsEditAction() // Chiamata AJAX per aggiornamento evento
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function eventsDeleteAction() // Chiamata AJAX per eliminare eventi
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function news() // Pagina di visualizzazione di tutti le news create dall'organizzatore
    {
        $this->data['title'] = 'News';

        $this->data['action'] = 'news';
        return view('frontend/organizers/news_view', $this->data);
    }

    public function newsAction() // Pagina di gestione della lista delle news, paginazione, ordinamento e ricerca avanzata
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function newsAdd() // Pagina form inserimento news
    {
        $this->data['title'] = 'Add News';

        $this->data['action'] = 'add';
        return view('frontend/organizers/add_news_view', $this->data);
    }

    public function newsAddOutput() // Chiamata AJAX reset form aggiungi news
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function newsAddAction() // Chiamata AJAX per inserimento news
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function newsEdit() // Pagina form aggiornamento news
    {
        $this->data['title'] = 'Edit News';

        $this->data['action'] = 'edit';
        return view('frontend/organizers/edit_news_view', $this->data);
    }

    public function newsEditOutput() // Chiamata AJAX refresh form aggiorna news
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function newsEditAction() // Chiamata AJAX per aggiornamento news
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function newsDeleteAction() // Chiamata AJAX per eliminare news
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function orders() // Pagina per visualizzare gli ordini dell'organizzatore
    {
        $this->data['title'] = 'Orders';

        $this->data['action'] = 'orders';
        return view('frontend/organizers/orders_view', $this->data);
    }

    public function ordersAction() // Chiamata AJAX per la gestione della lista eventi, paginazione, ordinamento e ricerca avanzata
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function logout()
    {
        $cookie = $this->request->getCookie('organizers_remember_me');

        if($cookie):
            $this->organizersModel->logoutByCookie($cookie);
            return redirect()->to('organizers/account/dashboard')->withCookies();
        else:
            $this->organizersModel->logoutBySession();
            return redirect()->to('organizers/account/dashboard');
        endif;
    }

    private function _getOrganizerOr404($slug)
    {
        $organizer = $this->organizersModel->getBySlug($slug);

        if(is_null($organizer)):
            throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('frontend/global.messages.itemNotFound'));
        else:
            return $organizer;
        endif;      
    }
}

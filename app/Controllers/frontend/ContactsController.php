<?php

namespace App\Controllers\frontend;

use App\Models\frontend\ContactsModel;

class ContactsController extends FrontendController
{
    private $contactsModel;

    public function __construct()
    {
       $this->contactsModel = New ContactsModel;
        $this->data['controller'] = 'contacts';
    }
    
    public function index()
    {
        $this->data['section'] = $this->contactsModel->getSector(6);

        $this->data['action'] = 'index';
        return view('frontend/contacts/index_view', $this->data);
    }

    public function indexAction()
    {
        if($this->request->isAJAX()):

            $token = csrf_hash();
            $rules = $this->contactsModel->validationRules;

            if( ! $this->validate($rules)):

                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('frontend/global.messages.validateError')];

                return $this->response->setJSON($json); die();

            else:

                $posts = $this->request->getPost();

                $json = $this->contactsModel->add($posts);
                $json['token'] = $token;

                return $this->response->setJSON($json); die();

            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }
}

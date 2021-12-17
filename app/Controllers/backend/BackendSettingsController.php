<?php

namespace App\Controllers\backend;

// use App\Models\backend\BackendSettingsModel;

class BackendSettingsController extends BackendController
{
    // private $backendSettingsModel;

    public function __construct()
    {
        // $this->backendSettingsModel = New BackendSettingsModel;
        $this->data['controller'] = 'backendsettings';
    }

    public function index()
    {
        $this->data['action'] = 'index';
        return view('backend/backendsettings/index_view', $this->data);
    }

    public function applicationAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function localizationAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function displayingAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function securityAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function debugAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }
}

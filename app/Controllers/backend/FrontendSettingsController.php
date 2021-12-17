<?php

namespace App\Controllers\backend;

// use App\Models\backend\FrontendSettingsModel;

class FrontendSettingsController extends BackendController
{
    // private $frontendSettingsModel;

    public function __construct()
    {
        // $this->frontendSettingsModel = New FrontendSettingsModel;
        $this->data['controller'] = 'frontendsettings';
    }

    public function index()
    {
        $this->data['section'] = $this->circuitsModel->getSector(1);

        $this->data['action'] = 'index';
        return view('backend/frontendsettings/index_view', $this->data);
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

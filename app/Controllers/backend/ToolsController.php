<?php

namespace App\Controllers\backend;

// use App\Models\backend\ToolsModel;

class ToolsController extends BackendController
{
    // private $toolsModel;

    public function __construct()
    {
        // $this->toolsModel = New ToolsModel;
        $this->data['controller'] = 'tools';
    }

    public function index()
    {
        $this->data['action'] = 'index';
        return view('backend/tools/index_view', $this->data);
    }

    public function repairTableAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function optimizeTableAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function optimizeDatabaseAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function backupAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function manageBackupsAction()
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }
}

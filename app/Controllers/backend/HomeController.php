<?php

namespace App\Controllers\backend;

class HomeController extends BackendController
{
    public function __construct()
    {
        $this->data['controller'] = 'home';
    }
    
    public function index()
    {
        $this->data['section'] = $this->homeModel->getSector(1);

        $this->data['action'] = 'index';
        return view('backend/home/index_view', $this->data);
    }
}

<?php

namespace App\Controllers\frontend;

use App\Models\frontend\HomeModel;

class HomeController extends FrontendController
{
    private $homeModel;

    public function __construct()
    {
        $this->homeModel = New HomeModel;
        $this->data['controller'] = 'home';
    }

    public function index()
    {
        $this->data['section'] = $this->homeModel->getSector(1);
        
        $modules = ['circuits', 'organizers', 'events', 'news'];
        foreach($modules as $module):
            $this->data[$module] = $this->homeModel->getData($module);
        endforeach;

        $this->data['action'] = 'index';
        return view('frontend/home/index_view', $this->data);
    }
}

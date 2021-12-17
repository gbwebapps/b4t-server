<?php

namespace App\Controllers\backend;

// use App\Models\backend\OrdersModel;

class OrdersController extends BackendController
{
    // private $ordersModel;

    public function __construct()
    {
        // $this->ordersModel = New OrdersModel;
        $this->data['controller'] = 'orders';
    }

    public function showAll()
    {
        $this->data['action'] = 'showAll';
        return view('backend/orders/show_all_view', $this->data);
    }

    public function showAllAction()
    {
        // some code here...
    }

    public function add()
    {
        $this->data['action'] = 'add';
        return view('backend/orders/add_view', $this->data);
    }

    public function addOutput()
    {
        // some code here...
    }

    public function addAction()
    {
        // some code here...
    }

    public function edit()
    {
        $this->data['action'] = 'edit';
        return view('backend/orders/edit_view', $this->data);
    }

    public function editOutput()
    {
        // some code here...
    }

    public function editAction()
    {
        // some code here...
    }

    public function deleteAction()
    {
        // some code here...
    }
}

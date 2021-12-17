<?php

namespace App\Controllers\backend;

use App\Models\backend\TransactionsModel;

class TransactionsController extends BackendController
{
    private $transactionsModel;

    public function __construct()
    {
        $this->transactionsModel = New TransactionsModel;
        $this->data['controller'] = 'transactions';
    }

    public function showAll()
    {
        $this->data['action'] = 'showAll';
        return view('backend/transactions/show_all_view', $this->data);
    }

    public function showAllAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->transactionsModel->searchFields : [];
            $searchIds = ($this->request->getPost('searchIds') == true) ? $this->transactionsModel->searchIds : [];
            $searchDate = ($this->request->getPost('searchDate') == true) ? $this->transactionsModel->searchDate : [];

            if( ! $this->validate(array_merge($searchFields, $searchIds, $searchDate))):

                $errors = array_replace_key(['searchFields.', 'searchIds.', 'searchDate.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('backend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->transactionsModel->getData($this->data['posts']);

            $output = view('backend/transactions/partials/_show_all_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function add()
    {
        $this->data['action'] = 'add';
        return view('backend/transactions/add_view', $this->data);
    }

    public function addOutput()
    {
        if($this->request->isAJAX()):

            $output = view('backend/transactions/partials/_add_view', $this->data);
            $json = ['output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function addAction()
    {
        if($this->request->isAJAX()):

            $rules = $this->transactionsModel->validationRules;
            $token = csrf_hash();

            if( ! $this->validate($rules)):
                $errors = array_replace_key(['.*'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'token' => $token, 'message' => lang('backend/global.messages.validateError')];

                return $this->response->setJSON($json); die();
            else:
                $json = $this->transactionsModel->add($this->request->getPost());
                $json['token'] = $token;

                return $this->response->setJSON($json); die();
            endif;

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(Int $id)
    {
        $this->data['transaction'] = $this->_getTransactionOr404($id);

        $this->data['action'] = 'show';
        return view('backend/transactions/show_view', $this->data);
    }

    private function _getTransactionOr404(Int $id)
    {
        $transaction = $this->transactionsModel->getID($id);

        if(is_null($transaction)):
            if($this->request->isAJAX()):
                return false;
            else:
                throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('backend/global.messages.itemNotFound'));
            endif;
        else:
            return $transaction;
        endif;      
    }
}

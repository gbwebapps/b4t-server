<?php

namespace App\Controllers\frontend;

use App\Models\frontend\NewsModel;

class NewsController extends FrontendController
{
    private $newsModel;

    public function __construct()
    {
        $this->newsModel = New NewsModel;
        $this->data['controller'] = 'news';
    }
    
    public function index()
    {
        $this->data['section'] = $this->newsModel->getSector(5);

        $this->data['action'] = 'index';
        return view('frontend/news/index_view', $this->data);
    }

    public function indexAction() // Chiamata AJAX per gestire la paginazione, l'ordinamento e la ricerca avanzata
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->newsModel->searchFields : [];

            if( ! $this->validate($searchFields)):

                $errors = array_replace_key(['searchFields.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('frontend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->newsModel->getData($this->data['posts']);

            $output = view('frontend/news/partials/_index_action_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show($slug) // Metodo per mostrare una news
    {
        // $this->data['new'] = $this->_getNewOr404($slug);

        $this->data['action'] = 'show';
        return view('frontend/news/show_view', $this->data);
    }

    private function _getNewOr404($id)
    {
        $new = $this->newsModel->getID($id);

        if(is_null($new)):
            throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('frontend/Global.messages.itemNotFound'));
        else:
            return $new;
        endif;      
    }
}

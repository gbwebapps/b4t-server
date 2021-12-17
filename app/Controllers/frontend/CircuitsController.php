<?php

namespace App\Controllers\frontend;

use App\Models\frontend\CircuitsModel;

class CircuitsController extends FrontendController
{
    private $circuitsModel;

    public function __construct()
    {
        $this->circuitsModel = New CircuitsModel;
        $this->data['controller'] = 'circuits';
    }

    public function index()
    {
        $this->data['section'] = $this->circuitsModel->getSector(2);
        
        $this->data['action'] = 'index';
        return view('frontend/circuits/index_view', $this->data);
    }

    public function indexAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->circuitsModel->searchFields : [];

            if( ! $this->validate($searchFields)):

                $errors = array_replace_key(['searchFields.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('frontend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $posts = $this->request->getPost();
            $this->data['data'] = $this->circuitsModel->getData($posts);

            $output = view('frontend/circuits/partials/_index_action_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(String $slug)
    {
        $this->data['items'] = $this->_getCircuitOr404($slug);
        $this->data['files'] = $this->circuitsModel->getFiles($this->data['items']['record']->circuits_id);

        $this->data['action'] = 'show';
        return view('frontend/circuits/show_view', $this->data);
    }

    public function getSubAction()
    {
        if($this->request->isAJAX()):

            $subSearchFields = ($this->request->getPost('subSearchFields') == true) ? $this->circuitsModel->subSearchFields : [];

            if( ! $this->validate($subSearchFields)):

                $errors = array_replace_key(['subSearchFields.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('frontend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $subPosts = $this->request->getPost();

            $this->data['subSection'] = $this->request->getPost('subSection');

            $this->data['data'] = $this->circuitsModel->getSubAction($subPosts, $this->data['subSection'], 'circuit');

            $output = view('frontend/circuits/partials/_get_events_action_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    private function _getCircuitOr404($slug)
    {
        $circuit = $this->circuitsModel->getBySlug($slug);

        if(is_null($circuit)):
            throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('frontend/global.messages.itemNotFound'));
        else:
            return $circuit;
        endif;      
    }
}

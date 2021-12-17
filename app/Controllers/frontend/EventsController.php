<?php

namespace App\Controllers\frontend;

use App\Models\frontend\EventsModel;

class EventsController extends FrontendController
{
    private $eventsModel;

    public function __construct()
    {
        $this->eventsModel = New EventsModel;
        $this->data['controller'] = 'events';
    }
    
    public function index()
    {
        $this->data['section'] = $this->eventsModel->getSector(4);

        $this->data['action'] = 'index';
        return view('frontend/events/index_view', $this->data);
    }

    public function indexAction()
    {
        if($this->request->isAJAX()):

            $searchFields = ($this->request->getPost('searchFields') == true) ? $this->eventsModel->searchFields : [];

            if( ! $this->validate($searchFields)):

                $errors = array_replace_key(['searchFields.'], '', $this->validator->getErrors());
                $json = ['errors' => $errors, 'message' => lang('frontend/global.messages.validateSearchCriteria')];

                return $this->response->setJSON($json); die();
            endif;

            $this->data['posts'] = $this->request->getPost();
            $this->data['data'] = $this->eventsModel->getData($this->data['posts']);

            $output = view('frontend/events/partials/_index_action_view', $this->data);
            $json = ['result' => true, 'output' => $output];

            return $this->response->setJSON($json); die();

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }

    public function show(String $slug)
    {
        $this->data['items'] = $this->_getEventOr404($slug);
        $this->data['files'] = $this->eventsModel->getFiles($this->data['items']['record']->events_id);

        $this->data['action'] = 'show';
        return view('frontend/events/show_view', $this->data);
    }

    private function _getEventOr404($slug)
    {
        $event = $this->eventsModel->getBySlug($slug);

        if(is_null($event)):
            throw new \CodeIgniter\Exceptions\PageNotFoundException(lang('frontend/global.messages.itemNotFound'));
        else:
            return $event;
        endif;      
    }
}

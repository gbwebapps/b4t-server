<?php

namespace App\Controllers\Backend;

use CodeIgniter\Controller;
use App\Libraries\AttachementsManager;

class AttachementsController extends Controller
{
	protected $attachements;

	public function showAttachements()
	{
		if($this->request->isAJAX()):

			$this->data['id'] = $this->request->getPost('id');
			$this->data['view'] = $this->request->getPost('view');
			$this->data['controller'] = $this->request->getPost('controller');

			$this->attachements = new AttachementsManager($this->data['controller']);

			if($result = $this->attachements->showAttachements($this->data['id'])):

				if(is_array($result)):

					$this->data['files'] = $result;

					$output = view('backend/template/attachements_view', $this->data);
					$json = ['output' => $output];

				else:
					$json = ['output' => lang('backend/global.messages.noFiles')];
				endif;

				return $this->response->setJSON($json); die();

			else:
				return $this->response->setJSON(['output' => lang('backend/global.messages.errorShowAttachements')]); die();
			endif;

		else:
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function deleteAttachement()
	{
		if($this->request->isAJAX()):

			$id = $this->request->getPost('id');
			$controller = $this->request->getPost('controller');

			$this->attachements = new AttachementsManager($controller);

			if($this->attachements->deleteAttachement($id)):
				return $this->response->setJSON(['result' => true, 'message' => lang('backend/global.messages.successDeleteAttachement')]); die();
			else:
				return $this->response->setJSON(['result' => false, 'output' => lang('backend/global.messages.errorDeleteAttachement')]); die();
			endif;

		else:
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function setCoverAttachement()
	{
		if($this->request->isAJAX()):

			$id = $this->request->getPost('id');
			$sectorid = $this->request->getPost('sectorid');
			$controller = $this->request->getPost('controller');

			$this->attachements = new AttachementsManager($controller);

			if($this->attachements->setCoverAttachement($id, $sectorid)):
				return $this->response->setJSON(['result' => true, 'message' => lang('backend/global.messages.successSetCoverAttachement')]); die();
			else:
				return $this->response->setJSON(['result' => false, 'output' => lang('backend/global.messages.errorSetCoverAttachement')]); die();
			endif;

		else:
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function removeCoverAttachement()
	{
		if($this->request->isAJAX()):

			$id = $this->request->getPost('id');
			$sectorid = $this->request->getPost('sectorid');
			$controller = $this->request->getPost('controller');

			$this->attachements = new AttachementsManager($controller);

			if($this->attachements->removeCoverAttachement($id, $sectorid)):
				return $this->response->setJSON(['result' => true, 'message' => lang('backend/global.messages.successRemoveCoverAttachement')]); die();
			else:
				return $this->response->setJSON(['result' => false, 'output' => lang('backend/global.messages.errorRemoveCoverAttachement')]); die();
			endif;

		else:
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}

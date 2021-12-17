<?php

namespace App\Models\backend;

class BackendModel
{
	protected $db;
	protected $builder;

	protected $table;
	protected $primaryKey;

	protected $allowedColumns;
	protected $allowedFields;

	protected $allowedLoginFields;
	protected $allowedRecoveryFields;
	protected $allowedSetPasswordFields;

	protected $selectGetData;
	protected $joinGetData;
	protected $groupByData;

	protected $selectGetID;
	protected $joinGetID;

	protected $controller;

	public $validationHeader = [
		'sections_title' => [
			'label'  => 'backend/global.form.title',
			'rules'  => 'required'
		],
		'sections_description' => [
			'label'  => 'backend/global.form.description',
			'rules'  => 'required'
		],
	];

	public $validationImage = [
		'sections_image' => [
			'label' => 'Files',
			'rules' => 'is_image[sections_image]|max_size[sections_image,10240]|ext_in[sections_image,jpg,gif,png]|max_dims[sections_image,5760,3240]'
		]
	];

	public $validationMetaTags = [
		'sections_meta_slug' => [
			'label'  => 'backend/global.form.slug',
			'rules'  => 'required'
		],
		'sections_meta_title' => [
			'label'  => 'backend/global.form.title',
			'rules'  => 'required'
		],
		'sections_meta_description' => [
			'label'  => 'backend/global.form.description',
			'rules'  => 'required'
		],
	];

	public function __construct()
	{
		$this->db = db_connect();
		$this->builder = $this->db->table($this->table);
	}

	public function getData(Array $posts, $currentUser = false) : Array
	{
		$getNumRows = [];

		$posts['order'] = (isset($posts['order']) && $posts['order'] == 'asc') ? 'desc' : 'asc';
		$posts['column'] = (isset($posts['column']) && in_array($posts['column'], $this->allowedColumns)) ? $posts['column'] : $this->primaryKey;

		$this->builder->select($this->selectGetData);

		if(isset($this->joinGetData) && ! empty($this->joinGetData)):
			foreach($this->joinGetData as $k => $v):
				$this->builder->join($k, $v, 'left');
			endforeach;
		endif;

		if((isset($posts['searchFields']))):
			foreach($posts['searchFields'] as $k => $v):
				if( ! empty($v)):
					$this->builder->like($k, $v);
				endif;
			endforeach;

			$getNumRows['searchFields'] = $posts['searchFields'];
		endif;

		if((isset($posts['searchDate']))):
			if( ! empty($posts['searchDate']['created_at_from'])):
				$this->builder->where($this->controller . '_created_at > ', $posts['searchDate']['created_at_from']);
			endif;
			if( ! empty($posts['searchDate']['created_at_to'])):
				$this->builder->where($this->controller . '_created_at < ', $posts['searchDate']['created_at_to']);
			endif;

			if( ! empty($posts['searchDate']['updated_at_from'])):
				$this->builder->where($this->controller . '_updated_at > ', $posts['searchDate']['updated_at_from']);
			endif;

			if( ! empty($posts['searchDate']['updated_at_to'])):
				$this->builder->where($this->controller . '_updated_at < ', $posts['searchDate']['updated_at_to']);
			endif;

			$getNumRows['searchDate'] = $posts['searchDate'];
		endif;

		if((isset($posts['searchIds']))):
			foreach($posts['searchIds'] as $k => $v):
				if( ! empty($v)):
					$this->builder->where($k, $v);
				endif;
			endforeach;

			$getNumRows['searchIds'] = $posts['searchIds'];
		endif;

		$this->builder->orderBy($posts['column'], $posts['order']);
		$this->builder->limit(5, ($posts['page'] - 1) * 5);

		if($currentUser && $this->controller == 'users'):
			$this->builder->where([$this->primaryKey . ' != ' => $currentUser->users_id]);
		endif;

		// qui mettere la discriminante per quali record visualizzare, trashed o regular
		// eccetto transactions che non ha quella colonna
		if($this->controller != 'transactions'):
			if($posts['whichRecords'] == 'regular'):
				$this->builder->where([$this->controller . '_deleted_at = ' => null]);
			elseif($posts['whichRecords'] == 'trashed'):
				$this->builder->where([$this->controller . '_deleted_at <> ' => null]);
			endif;
			$getNumRows['whichRecords'] = $posts['whichRecords'];
		endif;

		if(isset($this->groupByData) && ! empty($this->groupByData)):
			$this->builder->groupBy($this->groupByData);
		endif;

		$records = $this->builder->get();

		$totalRows = $this->_getNumRows($getNumRows, $currentUser);
		$itemLastPage = $totalRows - (($posts['page'] - 1) * 5); 
		$paramsPagination = ['page' => $posts['page'], 'limit' => 5, 'totalRows' => $totalRows];
		$pagination = ['page' => $posts['page'], 'limit' => 5, 'totalRows' => $totalRows];

		return ['records' => $records, 'pagination' => $pagination, 'itemLastPage' => $itemLastPage];
	}

	public function getID(Int $id) : ?Object
	{
		$this->builder->select($this->selectGetID);

		if(isset($this->joinGetID) && ! empty($this->joinGetID)):
			foreach($this->joinGetID as $k => $v):
				$this->builder->join($k, $v, 'left');
			endforeach;
		endif;

		$query = $this->builder->limit(1)->where([$this->primaryKey => $id]);

		return $query->get()->getRow();
	}

	private function _getNumRows(Array $params, $currentUser) : Int
	{
		$this->builder->select($this->selectGetData);

		if(isset($this->joinGetData) && ! empty($this->joinGetData)):
			foreach($this->joinGetData as $k => $v):
				$this->builder->join($k, $v, 'left');
			endforeach;
		endif;

		if((isset($params['searchFields']))):
			foreach($params['searchFields'] as $k => $v):
				if( ! empty($v)):
					$this->builder->like($k, $v);
				endif;
			endforeach;
		endif;

		if((isset($params['searchDate']))):
			if( ! empty($params['searchDate']['created_at_from'])):
				$this->builder->where($this->controller . '_created_at > ', $params['searchDate']['created_at_from']);
			endif;
			if( ! empty($params['searchDate']['created_at_to'])):
				$this->builder->where($this->controller . '_created_at < ', $params['searchDate']['created_at_to']);
			endif;

			if( ! empty($params['searchDate']['updated_at_from'])):
				$this->builder->where($this->controller . '_updated_at > ', $params['searchDate']['updated_at_from']);
			endif;

			if( ! empty($params['searchDate']['updated_at_to'])):
				$this->builder->where($this->controller . '_updated_at < ', $params['searchDate']['updated_at_to']);
			endif;
		endif;

		if((isset($params['searchIds']))):
			foreach($params['searchIds'] as $k => $v):
				if( ! empty($v)):
					$this->builder->where($k, $v);
				endif;
			endforeach;
		endif;

		if($currentUser && $this->controller == 'users'):
			$this->builder->where([$this->primaryKey . ' != ' => $currentUser->users_id]);
		endif;

		// qui mettere la discriminante per quali record visualizzare, trashed o regular
		// eccetto transactions che non ha quella colonna
		if($this->controller != 'transactions'):
			if($params['whichRecords'] == 'regular'):
				$this->builder->where([$this->controller . '_deleted_at = ' => null]);
			elseif($params['whichRecords'] == 'trashed'):
				$this->builder->where([$this->controller . '_deleted_at <> ' => null]);
			endif;
		endif;

		if(isset($this->groupByData) && ! empty($this->groupByData)):
			$this->builder->groupBy($this->groupByData);
		endif;

		return $this->builder->countAllResults();
	}

	protected function _checkAllowedFields(Array $posts, String $rules = 'allowedFields') : Array
	{
		foreach($posts as $k => $v):
			if( ! in_array($k, $this->{$rules})):
				unset($posts[$k]);
			endif;
		endforeach;

		return $posts;
	}

	public function doUpload($imagefile, $from = 'files')
	{
		$image = service('image');

		if(is_array($imagefile)):

			$filenames = [];

			foreach($imagefile[$from] as $img):

				if($img->isValid() && ! $img->hasMoved()):

					$filename = $img->getRandomName();
					$img->move('files/' . $this->controller . '/large', $filename);

						$fileSizes = ['medium' => [960, 540], 'small' => [150, 150]];

						foreach($fileSizes as $k => $v):
							$image->withFile('files/' . $this->controller . '/large/' . $filename)
								  ->fit($v[0], $v[1], 'center')
								  ->save('files/' . $this->controller . '/' . $k . '/' . $filename);
						endforeach;

					$filenames[] = $filename;

				endif;

			endforeach;

			return $filenames;

		else:

			if($imagefile->isValid() && ! $imagefile->hasMoved()):

				$filename = $imagefile->getRandomName();
				$imagefile->move('files/' . $this->controller . '/section/', $filename);

			endif;

			return $filename;

		endif;
	}

	protected function removeImages($files)
	{
		if(is_array($files)):

			$fileSizes = array('large', 'medium', 'small');

			foreach($files as $file):

				foreach($fileSizes as $size):

					if(file_exists('./files/' . $this->controller . '/' . $size . '/' . $file->files_name)):
						unlink('./files/' . $this->controller . '/' . $size . '/' . $file->files_name);
					endif;

				endforeach;

			endforeach;

		else:

			if(file_exists('./files/' . $this->controller . '/section/' . $files)):
				unlink('./files/' . $this->controller . '/section/' . $files);
			endif;

		endif;
	}

	public function getSector(Int $id): Object
	{
		$builder = $this->db->table('sections');
		return $builder->where(['sections_id' => $id])->limit(1)->get()->getRow();
	}

	public function sectionAction(Array $posts): Array
	{
		$this->db->transBegin();

		$builder = $this->db->table('sections');

		$section_id = (int)$posts['sections_id']; 

		if($posts['action'] == 'MetaTags'):
			$posts['sections_meta_slug'] = mb_url_title($posts['sections_meta_slug'], '-', true);
		endif;

		unset($posts['sections_id']); 
		unset($posts['csrf_test_name']);

		$action = $posts['action'];

		unset($posts['action']);
		unset($posts['view']);
		unset($posts['controller']);

		$posts['sections_updated_at'] = date('Y-m-d H:i:s');

		$builder->where(['sections_id' => $section_id])->update($posts);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/global.messages.' . lcfirst($action) . 'Fail')];
        else:
            $this->db->transCommit();
            $section = $builder->where(['sections_id' => $section_id])->get()->getRow();
            return ['result' => true, 
            		'message' => lang('backend/global.messages.' . lcfirst($action) . 'Success'), 
            		'section' => $section, 
            		'updatedDate' => ['sections_updated_at' => $section->sections_updated_at]
            	];
        endif;
	}

	public function removeSectionAttachement(Int $section_id): Array
	{
		$this->db->transBegin();

		$builder = $this->db->table('sections');

		$file = $builder->select('sections_image')->where(['sections_id' => $section_id])->get()->getRow('sections_image');

		$data = [];
		$data['sections_image'] = null;
		$data['sections_updated_at'] = date('Y-m-d H:i:s');

		$builder->where(['sections_id' => $section_id])->update($data);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/global.messages.ImageRemoveFail')];
        else:
            $this->db->transCommit();
            $this->removeImages($file);
            $section = $builder->where(['sections_id' => $section_id])->get()->getRow();
            return ['result' => true, 
            		'message' => lang('backend/global.messages.ImageRemoveSuccess'), 
            		'section' => $section, 
            		'updatedDate' => ['sections_updated_at' => $section->sections_updated_at]
            	];
        endif;
	}

	protected function sendEmail(Array $params): Bool
	{
		$to = $params['to'];
        $subject = $params['subject'];
        $controller = $params['controller'];
        
        $email = service('email');

        $email->setTo($to);
        $email->setFrom('amministratore@azienda.com', 'Registrazione utente');
        
        $email->setSubject($subject);

        $message = view('backend/' . $controller . '/_set_password_email_view', $params);

        $email->setMessage($message);

        if ($email->send()): 
            return true;
        endif; 
		
		return false;

		// $data = $email->printDebugger(['headers']);
	}
}
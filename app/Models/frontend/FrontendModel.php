<?php 

namespace App\Models\frontend;

class FrontendModel {
	protected $db;
	protected $builder;

	protected $table;
	protected $primaryKey;

	// protected $allowedColumns;
	protected $allowedFields;
	protected $allowedRegisterFields;
	protected $allowedLoginFields;
	protected $allowedRecoveryFields;
	protected $allowedSetPasswordFields;

	protected $selectGetData;
	protected $joinGetData;
	protected $whereData;
	protected $groupByData;

	// protected $selectGetID;
	// protected $joinGetID; 

	protected $controller;

	public $subSearchFields = [
		'subSearchFields.events_name' => [
	        'rules'  => 'permit_empty|alpha', 
	        'errors' => [
	            'alpha' => 'backend/global.messages.alpha'
	        ]
	    ],
    	'subSearchFields.news_name' => [
            'rules'  => 'permit_empty|alpha', 
            'errors' => [
                'alpha' => 'backend/global.messages.alpha'
            ]
        ],
	];

	public function __construct()
	{
		$this->db = db_connect();
		$this->builder = $this->db->table($this->table);
	}

	public function getData(Array $posts): Array
	{
		$getNumRows = [];

		$this->builder->select($this->selectGetData);

		if(isset($this->joinGetData) && ! empty($this->joinGetData)):
			foreach($this->joinGetData as $k => $v):
				$this->builder->join($k, $v);
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

		if(isset($this->whereData) && ! empty($this->whereData)):
			$this->builder->where($this->whereData);
		endif;

		$this->builder->orderBy($posts['column'], $posts['order']);
		$this->builder->limit(6, ($posts['page'] - 1) * 6);

		if(isset($this->groupByData) && ! empty($this->groupByData)):
			$this->builder->groupBy($this->groupByData);
		endif;

		$records = $this->builder->get();

		$totalRows = $this->_getNumRows($getNumRows);
		
		$paramsPagination = ['page' => $posts['page'], 'limit' => 6, 'totalRows' => $totalRows];
		$pagination = ['page' => $posts['page'], 'limit' => 6, 'totalRows' => $totalRows];

		return ['records' => $records, 'pagination' => $pagination];
	}

	public function getID(Int $id) : ?Object
	{
		$this->builder->select($this->selectGetID);

		if(isset($this->joinGetID) && ! empty($this->joinGetID)):
			foreach($this->joinGetID as $k => $v):
				$this->builder->join($k, $v);
			endforeach;
		endif;

		$query = $this->builder->limit(1)->where([$this->primaryKey => $id]);

		return $query->get()->getRow();
	}

	private function _getNumRows(Array $params): Int
	{
		$this->builder->select($this->selectGetData);

		if(isset($this->joinGetData) && ! empty($this->joinGetData)):
			foreach($this->joinGetData as $k => $v):
				$this->builder->join($k, $v);
			endforeach;
		endif;

		if((isset($params['searchFields']))):
			foreach($params['searchFields'] as $k => $v):
				if( ! empty($v)):
					$this->builder->like($k, $v);
				endif;
			endforeach;
		endif;

		if(isset($this->whereData) && ! empty($this->whereData)):
			$this->builder->where($this->whereData);
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

	public function getSector(Int $id): Object
	{
		$builder = $this->db->table('sections');
		return $builder->where(['sections_id' => $id])->limit(1)->get()->getRow();
	}

	public function getBySlug(String $slug)
	{
		$data = [];

		$data['record'] = $this->builder->join('meta_tags', 'meta_tags_entity_id = ' . $this->primaryKey)
										 ->where(['meta_tags_slug' => $slug, 'meta_tags_entity' => $this->controller])
										 ->get()
										 ->getRow();

		if( ! $data['record']) return null;

		return $data;
	}

	public function getSubAction(Array $posts, String $table, String $field)
	{
		$getNumRows = [];

		$getNumRows['field'] = $field;
		$getNumRows['table'] = $table;

		$getNumRows['id'] = (int)$posts['showID'];

		$builder = $this->db->table($table);

		$select = '' . $table . '_id, ' . $table . '_name, ' . $table . '_short_description, ' . $table . '_created_at, 
				   (select meta_tags_slug from meta_tags where meta_tags_entity = "' . $table . '" and meta_tags_entity_id = ' . $table . '_id) as meta_tags_slug, 
				   (select files_name from files where files_entity = "' . $table . '" and files_entity_id = ' . $table . '_id and files_is_cover = "1") as files_name';

		$builder->select($select);

		if((isset($posts['subSearchFields']))):
			foreach($posts['subSearchFields'] as $k => $v):
				if( ! empty($v)):
					$builder->like($k, $v);
				endif;
			endforeach;

			$getNumRows['subSearchFields'] = $posts['subSearchFields'];
		endif;

		$builder->where([$table . '_' . $field . '_id' => (int)$posts['showID']]);

		if($table == 'news'):
			$builder->where(['news_status' => 1]);
		endif;

		$builder->orderBy($table . '_id', 'desc');
		$builder->limit(6, ($posts['subPage'] - 1) * 6);

		$builder->groupBy($table . '_id');

		$records = $builder->get();

		$totalRows = $this->_getSubNumRows($getNumRows);
		
		$paramsPagination = ['page' => $posts['subPage'], 'limit' => 6, 'totalRows' => $totalRows];
		$pagination = ['page' => $posts['subPage'], 'limit' => 6, 'totalRows' => $totalRows];

		return ['records' => $records, 'pagination' => $pagination];
	}

	public function _getSubNumRows(Array $params): Int
	{
		$builder = $this->db->table($params['table']);

		$select = '' . $params['table'] . '_id, ' . $params['table'] . '_name, ' . $params['table'] . '_short_description, ' . $params['table'] . '_created_at, 
				   (select meta_tags_slug from meta_tags where meta_tags_entity = "' . $params['table'] . '" and meta_tags_entity_id = ' . $params['table'] . '_id) as meta_tags_slug, 
				   (select files_name from files where files_entity = "' . $params['table'] . '" and files_entity_id = ' . $params['table'] . '_id and files_is_cover = "1") as files_name';

		$builder->select($select);

		if((isset($params['subSearchFields']))):
			foreach($params['subSearchFields'] as $k => $v):
				if( ! empty($v)):
					$builder->like($k, $v);
				endif;
			endforeach;
		endif;

		$builder->where([$params['table'] . '_' .  $params['field'] . '_id' => (int)$params['id']]);

		$builder->groupBy($params['table'] . '_id');

		return $builder->countAllResults();
	}

	public function getFiles(Int $id)
	{
		$builder = $this->db->table('files');

		$data = [];

		$data['cover'] = $builder->where(['files_entity_id' => $id, 'files_entity' => $this->controller, 'files_is_cover' => '1'])
							  	 ->get()
							  	 ->getRow();

		$data['images'] = $builder->where(['files_entity_id' => $id, 'files_entity' => $this->controller, 'files_is_cover' => '0'])
							  	 ->get()
							  	 ->getResult();

		return $data;
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

        $message = view('frontend/' . $controller . '/_set_password_email_view', $params);

        $email->setMessage($message);

        if ($email->send()): 
            return true;
        endif; 
		
		return false;

		// $data = $email->printDebugger(['headers']);
	}
}
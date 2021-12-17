<?php

namespace App\Models\backend;

class CircuitsModel extends BackendModel
{
	protected $table = 'circuits';
	protected $primaryKey = 'circuits_id';

	protected $allowedColumns = ['circuits_id', 
								 'circuits_name', 
								 'circuits_email', 
								 'circuits_phone'];

	protected $allowedFields = ['circuits_id', 
								'circuits_name', 
								'circuits_address', 
								'circuits_email', 
								'circuits_phone', 
								'circuits_opening_time', 
								'circuits_short_description', 
								'circuits_long_description', 
								'filenames', 
								'slug', 
								'title',
								'description'];

	protected $selectGetData = 'circuits_id, 
								(select files_name from files where files_entity_id = circuits_id and files_entity = "circuits" and files_is_cover = "1") as avatar, 
								circuits_name, 
								circuits_email, 
								circuits_phone, 
								circuits_created_at, 
								circuits_updated_at, 
								circuits_deleted_at';

	protected $selectGetID = 'circuits_id, 
							  circuits_name, 
							  circuits_address, 
							  circuits_email, 
							  circuits_phone, 
							  circuits_opening_time, 
							  circuits_short_description, 
							  circuits_long_description, 
							  circuits_created_at, 
							  circuits_updated_at, 
							  circuits_deleted_at,  
							  meta_tags_slug, 
							  meta_tags_title, 
							  meta_tags_description';

	protected $joinGetID = [
		'meta_tags' => 'meta_tags.meta_tags_entity_id = circuits.circuits_id and meta_tags.meta_tags_entity = "circuits"'
	];

	protected $controller = 'circuits';

	public function validationRules($uniqids)
	{
		$rules = [
			'circuits_name' => [
				'label'  => 'backend/circuits.form.circuitField',
				'rules'  => 'required|is_unique[circuits.circuits_name,circuits_id,{circuits_id}]'
			], 
			'circuits_address' => [
				'label'  => 'backend/circuits.form.addressField',
				'rules'  => 'required' // filtro
			],
			'circuits_email' => [
				'label'  => 'backend/circuits.form.emailField',
				'rules'  => 'valid_email|is_unique[circuits.circuits_email,circuits_id,{circuits_id}]'
			],
			'circuits_phone' => [
				'label'  => 'backend/circuits.form.phoneField',
				'rules'  => 'required|is_unique[circuits.circuits_phone,circuits_id,{circuits_id}]'
			],
			'circuits_opening_time' => [
				'label'  => 'backend/circuits.form.openingTimeField',
				'rules'  => 'required' // filtro
			],
			'circuits_short_description' => [
				'label'  => 'backend/circuits.form.shortDescriptionField',
				'rules'  => 'required' // filtro
			],
			'circuits_long_description' => [
				'label'  => 'backend/circuits.form.longDescriptionField',
				'rules'  => 'required' // filtro
			],
			'slug' => [
				'label'  => 'backend/global.form.slug',
				'rules'  => 'required' // filtro
			],
			'title' => [
				'label'  => 'backend/global.form.title',
				'rules'  => 'required' // filtro
			],
			'description' => [
				'label'  => 'backend/global.form.description',
				'rules'  => 'required' // filtro
			],
	        'files' => [
	        	'label' => 'Files',
	        	'rules' => 'is_image[files]|max_size[files,10240]|ext_in[files,jpg,gif,png]|max_dims[files,4032,3024]'
	        ]
	    ];

	    if($uniqids):

	    	foreach($uniqids as $uniqid):

	    		$rules['services_' . $uniqid . '.*'] = [
					'label'  => 'backend/circuits.form.servicesField',
					'rules'  => 'required|alpha_dash', 
					'errors' => [
						'required' => 'backend/circuits.errors.servicesError',
					]
				];

				$rules['types_' . $uniqid . '.*'] = [
					'label'  => 'backend/circuits.form.typesField',
					'rules'  => 'required|is_natural_no_zero', 
					'errors' => [
						'required' => 'backend/circuits.errors.typesError',
					]
				];

	    	endforeach;

	    else:

	    	$rules['types_services'] = [
	    		'rules'  => 'required',
	    		'errors' => [
	    			'required' => 'Circuit type and services are missing',
	    		]
	    	];

	    endif;

	    return $rules;
	}

	public $searchFields = [
	    'searchFields.circuits_id' => [
	        'rules'  => 'permit_empty|integer', 
	        'errors' => [
	            'integer' => 'backend/global.messages.integer'
	        ]
	    ],
	    'searchFields.circuits_name' => [
	        'rules'  => 'permit_empty|alpha_numeric', 
	        'errors' => [
	            'alpha_numeric' => 'backend/global.messages.alpha_numeric'
	        ]
	    ],
	    'searchFields.circuits_email' => [
	        'rules'  => 'permit_empty|alpha_numeric', 
	        'errors' => [
	            'alpha_numeric' => 'backend/global.messages.alpha_numeric'
	        ]
	    ],
	    'searchFields.circuits_phone' => [
	        'rules'  => 'permit_empty|alpha_numeric', 
	        'errors' => [
	            'alpha_numeric' => 'backend/global.messages.alpha_numeric'
	        ]
	    ]
	];

	public $searchIds = [];

	public $searchDate = [];

	public function add(Array $posts): Array
	{
		$this->db->transBegin();

			$postServices = [];
			$postTypes = [];
			// Eseguo lo storage dei post services prima che vengano eliminati 
			// da _checkAllowedFields // Sia $posts['uniqid'] che $posts['services_' . $uniqid] verranno eliminati 
			// da _checkAllowedFields poiche non sono contenuti nell'array $allowedFields
			foreach($posts['uniqid'] as $uniqid):
				$postServices[] = $posts['services_' . $uniqid];
				$postTypes[] = $posts['types_' . $uniqid];
			endforeach;
			$postServices = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($postServices));

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			// echo '<pre>' . print_r($posts, true) . '</pre>'; die();

			// Estraggo ed elimino i posts di eventuali files
			if(isset($posts['filenames']) && ! empty($posts['filenames'])):
				$filenames = $posts['filenames'];
			endif;
			unset($posts['filenames']);

			$posts['circuits_created_at'] = date('Y-m-d H:i:s');

			// Estraggo ed elimino i meta tags
			$meta_tags = [];

			$slug = mb_url_title($posts['slug'], '-', true);

			$meta_tags['meta_tags_entity'] = $this->controller;
			$meta_tags['meta_tags_slug'] = $slug;
			$meta_tags['meta_tags_title'] = $posts['title'];
			$meta_tags['meta_tags_description'] = $posts['description'];

			unset($posts['slug'], $posts['title'], $posts['description']);

			// Inserisco i dati nella tabella principale
			$this->builder->insert($posts);
			$id = $this->db->insertID();

			// Inserisco i dati pertinenti nella tabella meta_tags
			$meta_tags['meta_tags_entity_id'] = $id;
			$builder = $this->db->table('meta_tags');
			$builder->insert($meta_tags);

			// Ciclo i types
			$types = [];
			foreach($postTypes as $k => $v):
				
				$types[$k]['circuit_id'] = $id;
				$types[$k]['type_id'] = $v;

			endforeach;

			// Ciclo i services
			$services = []; $i = 0;
			foreach($postServices as $val):
				$arr = explode('_', $val);

				$services[$i]['type_id'] = $arr[1];
				$services[$i]['circuit_id'] = $id;
				$services[$i]['service_id'] = $arr[0];

				$i += 1;
			endforeach;

			// Inserisco i types
			$builder = $this->db->table('circuit_type');
			$builder->insertBatch($types);

			// Inserisco i services
			$builder = $this->db->table('circuit_service');
			$builder->insertBatch($services);

			// Se esistono files allegati li ciclo e li inserisco
			if(isset($filenames) && ! empty($filenames)):
				$dataFiles = [];

				foreach($filenames as $k => $v):
					
					$dataFiles[$k]['files_is_cover'] = (($k === 0) ? '1' : '0');
					$dataFiles[$k]['files_entity_id'] = $id;
					$dataFiles[$k]['files_entity'] = $this->controller;
					$dataFiles[$k]['files_name'] = $v;

				endforeach;

				$builder = $this->db->table('files');
				$builder->insertBatch($dataFiles);
			endif;

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/circuits.messages.insertFail')];
        else:
            $this->db->transCommit();
            $circuit = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/circuits.messages.insertSuccess', [esc($circuit->circuits_name), $id])];
        endif;
	}

	public function edit(Array $posts): Array
	{
		$this->db->transBegin();
		
			$postServices = [];
			// Eseguo lo storage dei post services prima che vengano eliminati 
			// da _checkAllowedFields // Sia $posts['uniqid'] che $posts['services_' . $uniqid] verranno eliminati 
			// da _checkAllowedFields poiche non sono contenuti nell'array $allowedFields
			foreach($posts['uniqid'] as $uniqid):
				$postServices[] = $posts['services_' . $uniqid];
			endforeach;
			$postServices = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($postServices));

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			if(isset($posts['filenames']) && ! empty($posts['filenames'])):
				$filenames = $posts['filenames'];
			endif;
			unset($posts['filenames']);

			$id = (int)$posts[$this->primaryKey];

			$posts['circuits_updated_at'] = date('Y-m-d H:i:s');

			$meta_tags = [];

			// qui dovrò creare lo slug automatico
			// qui dovrò creare il title automatico
			// qui dovrò creare la description automatica

			$meta_tags['meta_tags_slug'] = $posts['slug'];
			$meta_tags['meta_tags_title'] = $posts['title'];
			$meta_tags['meta_tags_description'] = $posts['description'];
			unset($posts['slug'], $posts['title'], $posts['description']);

			// Estraggo ed elimino types
			$postTypes = $posts['types']; // Array degli id dei types provenienti dal form
			unset($posts['types']);

			// Aggiorno i dati nella tabella principale
			$this->builder->update($posts, [$this->primaryKey => $id]);

			// Aggiorno i dati pertinenti nella tabella meta_tags
			$builder = $this->db->table('meta_tags');
			$builder->update($meta_tags, ['meta_tags_entity_id' => $id, 'meta_tags_entity' => $this->controller]);

			// Ciclo i types
			$types = [];
			foreach($postTypes as $k => $v):
				
				$types[$k]['circuit_id'] = $id;
				$types[$k]['type_id'] = $k;

			endforeach;
			
			// Ciclo i services
			$services = []; $i = 0;
			foreach($postServices as $val):
				$arr = explode('_', $val);

				$services[$i]['type_id'] = $arr[1];
				$services[$i]['circuit_id'] = $id;
				$services[$i]['service_id'] = $arr[0];

				$i += 1;
			endforeach;

			// Inserisco i types
			$builder = $this->db->table('circuit_type');
			$builder->delete(['circuit_id' => $id]);
			$builder->insertBatch($types);

			// Inserisco i services
			$builder = $this->db->table('circuit_service');
			$builder->delete(['circuit_id' => $id]);
			$builder->insertBatch($services);

			if(isset($filenames) && ! empty($filenames)):
				$dataFiles = [];

				// query per sapere se questa entità ha almeno una immagine in is_cover 1
				$builder = $this->db->table('files');
				$query = $builder->getwhere(['files_entity_id' => $id, 'files_is_cover' => '1', 'files_entity' => $this->controller]);

				$flag = ($query->getRow()) ? true : false;

				foreach($filenames as $k => $v):
					if($flag):
						$dataFiles[$k]['files_is_cover'] = '0';
					else:
						$dataFiles[$k]['files_is_cover'] = (($k === 0) ? '1' : '0');
					endif;

					$dataFiles[$k]['files_entity'] = $this->controller;
					$dataFiles[$k]['files_entity_id'] = $id;
					$dataFiles[$k]['files_name'] = $v;
				endforeach;

				$builder = $this->db->table('files');
				$builder->insertBatch($dataFiles);
			endif;

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/circuits.messages.updateFail'), 'circuit' => ''];
        else:
            $this->db->transCommit();
            $circuit = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/circuits.messages.updateSuccess', [esc($circuit->circuits_name), $id]), 'circuit' => $circuit];
        endif;
	}

	public function delete(Int $id): Array
	{
		$this->db->transBegin();

			$circuit = $this->getID($id);

			// $builder = $this->db->table('meta_tags');
			// $builder->delete(['meta_tags_entity_id' => $id, 'meta_tags_entity' => $this->controller]);

			// $builder = $this->db->table('circuit_type');
			// $builder->delete(['circuit_id' => $id]);

			// $builder = $this->db->table('circuit_service');
			// $builder->delete(['circuit_id' => $id]);

			// $builder = $this->db->table('files');
			// $builder->select('files_name');
			// $files = $builder->getWhere(['files_entity_id' => $id, 'files_entity' => $this->controller])->getResult();
			// $builder->delete(['files_entity_id' => $id, 'files_entity' => $this->controller]);

			$data = [];

			if($circuit->circuits_deleted_at == null):
				$data['circuits_deleted_at'] = date('Y-m-d H:i:s');
				$messageType = 'delete';
			else:
				$data['circuits_deleted_at'] = null;
				$messageType = 'restore';
			endif;

			// $this->builder->delete([$this->primaryKey => $id]);
			$this->builder->update($data, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/circuits.messages.' . $messageType . 'Fail')];
        else:
            // $this->removeImages($files);
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/circuits.messages.' . $messageType . 'Success', [esc($circuit->circuits_name), $id])];
        endif;
	}

	public function selectServices(Int $id): Array
	{
		$builder = $this->db->table('circuits_services');
		return $builder->select('id, service, type_id')->getWhere(['type_id' => $id])->getResult();
	}
	
}

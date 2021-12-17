<?php

namespace App\Models\backend;

use App\Libraries\Token;

class OrganizersModel extends BackendModel
{
	protected $table = 'organizers';
	protected $primaryKey = 'organizers_id';

	protected $allowedColumns = ['organizers_id', 
								 'organizers_name', 
								 'organizers_vat', 
								 'organizers_email', 
								 'organizers_phone', 
								 'balance'];

	protected $allowedFields = ['organizers_id', 
								'organizers_name', 
								'organizers_address', 
								'organizers_vat', 
								'organizers_email', 
								'organizers_phone', 
								'organizers_coins', 
								'organizers_short_description', 
								'organizers_long_description', 
								'filenames', 
								'slug', 
								'title',
								'description'];

	protected $selectGetData = 'organizers_id, 
								(select files_name from files where files_entity_id = organizers_id and files_entity = "organizers" and files_is_cover = "1") as avatar, 
								organizers_name, 
								organizers_vat, 
								organizers_email, 
								organizers_phone, 
								(select transactions_balance from transactions where transactions_organizer_id = organizers_id and transactions_id = (select max(transactions_id) from transactions where transactions_organizer_id = organizers_id)) as balance, 
								organizers_created_at, 
								organizers_updated_at, 
								organizers_deleted_at';

	protected $selectGetID = 'organizers_id, 
							  organizers_name, 
							  organizers_address, 
							  organizers_vat, 
							  organizers_email, 
							  organizers_phone, 
							  organizers_coins, 
							  (select transactions_balance from transactions where transactions_organizer_id = organizers_id and transactions_id = (select max(transactions_id) from transactions where transactions_organizer_id = organizers_id)) as balance, 
							  organizers_short_description, 
							  organizers_long_description, 
							  organizers_created_at, 
							  organizers_updated_at,
							  organizers_deleted_at, 
							  meta_tags_slug, 
							  meta_tags_title, 
							  meta_tags_description';

	protected $joinGetID = [
		'meta_tags' => 'meta_tags.meta_tags_entity_id = organizers.organizers_id and meta_tags.meta_tags_entity = "organizers"'
	];

	protected $controller = 'organizers';

	public function validationRules($uniqids)
	{
		$rules = [
			'organizers_name' => [
				'label'  => 'backend/organizers.form.organizerField',
				'rules'  => 'required|is_unique[organizers.organizers_name,organizers_id,{organizers_id}]'
			], 
			'organizers_address' => [
				'label'  => 'backend/organizers.form.addressField',
				'rules'  => 'required' // filtro
			],
			'organizers_vat' => [
				'label'  => 'backend/organizers.form.vatField',
				'rules'  => 'required|is_unique[organizers.organizers_vat,organizers_id,{organizers_id}]'
			],
			'organizers_email' => [
				'label'  => 'backend/organizers.form.emailField',
				'rules'  => 'valid_email|is_unique[organizers.organizers_email,organizers_id,{organizers_id}]'
			],
			'organizers_phone' => [
				'label'  => 'backend/organizers.form.phoneField',
				'rules'  => 'required|is_unique[organizers.organizers_phone,organizers_id,{organizers_id}]'
			],
			'organizers_coins' => [
				'label'  => 'backend/organizers.form.coinsField',
				'rules'  => 'required|integer' // filtro
			],
			'organizers_short_description' => [
				'label'  => 'backend/organizers.form.shortDescriptionField',
				'rules'  => 'required' // filtro
			],
			'organizers_long_description' => [
				'label'  => 'backend/organizers.form.longDescriptionField',
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

	    		$rules['circuits_' . $uniqid . '.*'] = [
					'label'  => 'backend/organizers.form.circuitsField',
					'rules'  => 'required|is_natural_no_zero', 
					'errors' => [
						'required' => 'backend/organizers.errors.circuitsError',
					]
				];

				$rules['types_' . $uniqid . '.*'] = [
					'label'  => 'backend/organizers.form.typesField',
					'rules'  => 'required|alpha_dash', 
					'errors' => [
						'required' => 'backend/organizers.errors.typesError',
					]
				];

				$rules['coins_' . $uniqid . '.*'] = [
					'label'  => 'backend/organizers.form.coinsField',
					'rules'  => 'required|is_natural_no_zero', 
					'errors' => [
						'required' => 'backend/organizers.errors.coinsError',
					]
				];

	    	endforeach;

	    else:

	    	$rules['circuits_types_coins'] = [
	    		'rules'  => 'required',
	    		'errors' => [
	    			'required' => 'Circuits, types and coins are missing',
	    		]
	    	];

	    endif;

	    return $rules;
	}

	public $searchFields = [
	    'searchFields.organizers_id' => [
	        'rules'  => 'permit_empty|integer', 
	        'errors' => [
	            'integer' => 'backend/global.messages.integer'
	        ]
	    ],
	    'searchFields.organizers_name' => [
	        'rules'  => 'permit_empty|alpha_numeric', 
	        'errors' => [
	            'alpha_numeric' => 'backend/global.messages.alpha_numeric'
	        ]
	    ],
	    'searchFields.organizers_email' => [
	        'rules'  => 'permit_empty|alpha_numeric', 
	        'errors' => [
	            'alpha_numeric' => 'backend/global.messages.alpha_numeric'
	        ]
	    ],
	    'searchFields.organizers_phone' => [
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

			$items = []; // Creo array items per raccogliere la triade circuito, tipo e coins

			// I posts 'uniqid', 'circuits_', 'types_' e 'coins_', vengono messi nell'array items
			// per essere in seguito ciclati assieme all'id dell'organizzatore e popolare la tabella organizer_circuit, 
			// ed inoltre, perché in seguito verranno rimossi dal metodo _checkAllowedFields in quanto non presenti nell'array che questo metodo filtra.
			foreach($posts['uniqid'] as $key => $uniqid):

				foreach($posts['circuits_' . $uniqid] as $k => $v):
					$items[$key]['circuit_id'] = $v;
				endforeach;

				foreach($posts['types_' . $uniqid] as $k => $v):
					$items[$key]['type_id'] = $v;
				endforeach;

				foreach($posts['coins_' . $uniqid] as $k => $v):
					$items[$key]['coins'] = $v;
				endforeach;
				
			endforeach;

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			// Estraggo ed elimino i posts di eventuali files
			if(isset($posts['filenames']) && ! empty($posts['filenames'])):
				$filenames = $posts['filenames'];
			endif;
			unset($posts['filenames']);

			$posts['organizers_created_at'] = date('Y-m-d H:i:s');

			$token = new Token();
			$posts['organizers_activation_hash'] = $token->getHash();
			$posts['organizers_activation_expire'] = date('Y-m-d H:i:s', time() + 43200);

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

			// Ciclo i circuits
			$circuits = []; $i = 0;
			foreach($items as $k => $v):

				$circuits[$i]['organizer_id'] = $id; // organizzatore
				$circuits[$i]['circuit_id'] = $v['circuit_id']; // Il circuito
				$circuits[$i]['type_id'] = $v['type_id']; // Il tipo di circuito
				$circuits[$i]['coins'] = $v['coins']; // I coins assegnati a questo organizzatore per questo circuito

				$i += 1;

			endforeach;

			// Inserisco i circuits
			$builder = $this->db->table('organizer_circuit');
			$builder->insertBatch($circuits);

			// Popolo la tabella transactions
			$transactions = [];

			$transactions['transactions_organizer_id'] = $id;
			$transactions['transactions_reason_code'] = 3; // Il reason code 3 corrisponde al primo deposito in assoluto
			$transactions['transactions_reason'] = lang('backend/transactions.form.reasonFirstDeposit');
			$transactions['transactions_amount'] = (int)$posts['organizers_coins'];
			$transactions['transactions_balance'] = (int)$posts['organizers_coins'];
			$transactions['transactions_created_at'] = date('Y-m-d H:i:s');

			$builder = $this->db->table('transactions');
			$builder->insert($transactions);

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
            $organizer = $this->getID($id);

            $params = [
            	'to' => esc($organizer->organizers_email), 
            	'subject' => 'Registration organizer ' . esc($organizer->organizers_name), 
            	'name' => esc($organizer->organizers_name), 
            	'email' => esc($organizer->organizers_email), 
            	'token' => $token->getValue(), 
            	'controller' => 'organizers', 
            	'action' => 'activation', 
        	];

        	if( ! $this->sendEmail($params)):
        		$message = lang('backend/organizers.messages.insertNoMailSuccess', [esc($organizer->organizers_name), $id]);
        	else:
        		$message = lang('backend/organizers.messages.insertSuccess', [esc($organizer->organizers_name), $id]);
        	endif;

        endif;

        return ['result' => true, 'message' => $message];
	}

	public function delete(Int $id): Array
	{
		$this->db->transBegin();

			$organizer = $this->getID($id);

			// $builder = $this->db->table('meta_tags');
			// $builder->delete(['meta_tags_entity_id' => $id, 'meta_tags_entity' => $this->controller]);

			// $builder = $this->db->table('organizer_circuit');
			// $builder->delete(['organizer_id' => $id]);

			// $builder = $this->db->table('files');
			// $builder->select('files_name');
			// $files = $builder->getWhere(['files_entity_id' => $id, 'files_entity' => $this->controller])->getResult();
			// $builder->delete(['files_entity_id' => $id, 'files_entity' => $this->controller]);

			$data = [];

			if($organizer->organizers_deleted_at == null):
				$data['organizers_deleted_at'] = date('Y-m-d H:i:s');
				$messageType = 'delete';
			else:
				$data['organizers_deleted_at'] = null;
				$messageType = 'restore';
			endif;

			// $this->builder->delete([$this->primaryKey => $id]);
			$this->builder->update($data, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/organizers.messages.' . $messageType . 'Fail')];
        else:
            // $this->removeImages($files);
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/organizers.messages.' . $messageType . 'Success', [esc($organizer->organizers_name), $id])];
        endif;
	}

	public function selectTypes(Int $id): String
	{
		$output = '';

		$builder = $this->db->table('circuits_types');
		$types = $builder->select('circuits_types.id, circuits_types.type')
			    		 ->join('circuit_type', 'circuit_type.type_id = circuits_types.id')
			    		 ->getWhere(['circuit_type.circuit_id' => $id])
			    		 ->getResult();

		$output .= '<option value="">' . lang('backend/organizers.form.typesSelect') . '</option>';

		foreach($types as $type):
			$output .= '<option value="' . $type->id . '">' . $type->type . '</option>';
		endforeach;

		return $output;
	}
}

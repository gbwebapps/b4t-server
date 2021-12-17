<?php

namespace App\Models\backend;

class EventsModel extends BackendModel
{
	protected $table = 'events';
	protected $primaryKey = 'events_id';

	protected $allowedColumns = ['events_id', 
								 'events_name', 
								 'events_organizer_id', 
								 'events_circuit_id', 
								 'events_type', 
								 'events_status'];

	protected $allowedFields = ['events_name', 
								'events_organizer_id', 
								'events_circuit_id', 
								'events_type_id', 
								'events_short_description', 
								'events_long_description', 
								'filenames', 
								'slug', 
								'title',
								'description'];

	protected $selectGetData = 'events_id, 
								(select files_name from files where files_entity_id = events_id and files_entity = "events" and files_is_cover = "1") as avatar, 
								events_name, 
								(select organizers_name from organizers where organizers_id = events_organizer_id) as organizer,  
								(select circuits_name from circuits where circuits_id = events_circuit_id) as circuit,  
								(select type from circuits_types where id = events_type_id) as type,  
								events_status, 
								events_created_at, 
								events_updated_at, 
								events_deleted_at';

	protected $selectGetID = 'events_id, 
							  events_name, 
							  (select organizers_name from organizers where organizers_id = events_organizer_id) as organizer,  
							  (select circuits_name from circuits where circuits_id = events_circuit_id) as circuit,  
							  (select type from circuits_types where id = events_type_id) as type, 
							  events_short_description, 
							  events_long_description, 
							  events_status, 
							  events_created_at, 
							  events_updated_at, 
							  events_deleted_at, 
							  meta_tags_slug, 
							  meta_tags_title, 
							  meta_tags_description';

	protected $joinGetID = [
		'meta_tags' => 'meta_tags.meta_tags_entity_id = events.events_id and meta_tags.meta_tags_entity = "events"'
	];

	protected $controller = 'events';

	public function validationRules($uniqids, $subUniqids)
	{
		$rules = [
			'events_name' => [
				'label'  => 'backend/events.form.eventField',
				'rules'  => 'required'
			], 
			'events_organizer_id' => [
				'label'  => 'backend/events.form.organizerIdField',
				'rules'  => 'required|is_natural_no_zero'
			], 
			'events_circuit_id' => [
				'label'  => 'backend/events.form.circuitIdField',
				'rules'  => 'required|is_natural_no_zero'
			], 
			'events_type_id' => [
				'label'  => 'backend/events.form.typeIdField',
				'rules'  => 'required|is_natural_no_zero'
			],  
			'events_short_description' => [
				'label'  => 'backend/events.form.shortDescriptionField',
				'rules'  => 'required' // filtro
			],
			'events_long_description' => [
				'label'  => 'backend/events.form.longDescriptionField',
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

				$rules['dates_' . $uniqid . '.*'] = [
					'label'  => 'backend/events.form.dateField',
					'rules'  => 'required', // qui filtri adeguati 
					'errors' => [
						'required' => 'backend/events.errors.dateError',
					]
				];

				$rules['slots_' . $uniqid . '.*'] = [
					'label'  => 'backend/events.form.slotField',
					'rules'  => 'required|is_natural_no_zero', 
					'errors' => [
						'required' => 'backend/events.errors.slotError',
					]
				];

				$rules['qty_' . $uniqid . '.*'] = [
					'label'  => 'backend/events.form.quantityField',
					'rules'  => 'required|integer', 
					'errors' => [
						'required' => 'backend/events.errors.qtyError',
					]
				];

				$rules['prices_' . $uniqid . '.*'] = [
					'label'  => 'backend/events.form.priceField',
					'rules'  => 'required|integer', 
					'errors' => [
						'required' => 'backend/events.errors.priceError',
					]
				];

				if($subUniqids):

					foreach($subUniqids as $subUniqid):

						$rules['services_' . $subUniqid . '.*'] = [
							'label'  => 'backend/events.form.servicesField',
							'rules'  => 'required|is_natural_no_zero', 
							'errors' => [
								'required' => 'backend/events.errors.servicesError',
							]
						];

						$rules['services_prices_' . $subUniqid . '.*'] = [
							'label'  => 'backend/events.form.priceField',
							'rules'  => 'required|integer', 
							'errors' => [
								'required' => 'backend/events.errors.priceError',
							]
						];

						$rules['mandatory_' . $subUniqid . '.*'] = [
							'label'  => 'backend/events.form.mandatoryField',
							'rules'  => 'required|in_list[0,1]', 
							'errors' => [
								'in_list' => 'backend/events.errors.not_allowed',
							]
						];

					endforeach;

				else:

					$rules['services'] = [
						'rules'  => 'required',
						'errors' => [
							'required' => 'Services are missing',
						]
					];

				endif;

			endforeach;

		else:

			$rules['dates_slots'] = [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Date, slot, quantity and price are missing',
				]
			];

		endif;

		return $rules;
	}

	public $searchFields = [
	    'searchFields.events_id' => [
	        'rules'  => 'permit_empty|integer', 
	        'errors' => [
	            'integer' => 'backend/global.messages.integer'
	        ]
	    ],
	    'searchFields.events_name' => [
	        'rules'  => 'permit_empty|alpha', 
	        'errors' => [
	            'alpha' => 'backend/global.messages.alpha'
	        ]
	    ]
	];

	public $searchIds = [
	    'searchIds.events_organizer_id' => [
	        'rules'  => 'permit_empty|is_natural_no_zero', 
	        'errors' => [
	            'is_natural_no_zero' => 'backend/global.messages.integer'
	        ]
	    ], 
	    'searchIds.events_circuit_id' => [
	        'rules'  => 'permit_empty|is_natural_no_zero', 
	        'errors' => [
	            'is_natural_no_zero' => 'backend/global.messages.integer'
	        ]
	    ], 
	    'searchIds.events_type_id' => [
	        'rules'  => 'permit_empty|is_natural_no_zero', 
	        'errors' => [
	            'is_natural_no_zero' => 'backend/global.messages.integer'
	        ]
	    ]
	];

	public $searchDate = [];

	public function add(Array $posts): Array
	{
		$this->db->transBegin();

			$items = []; // Creo array items per raccogliere la quaterna data, slot, quantità e prezzo
			$subItems = []; // Creo array subItems per raccogliere la terna servizio, prezzo e obbligatorietà

			// I posts 'uniqid', 'dates_', 'slots_', 'qty_' e 'prices_', vengono messi nell'array items
			// per essere in seguito ciclati assieme all'id dell'evento e popolare la tabella event_service, 
			// ed inoltre, perché in seguito verranno rimossi dal metodo _checkAllowedFields in quanto non presenti nell'array che questo metodo filtra.

			foreach($posts['uniqid'] as $uniqid):

				foreach($posts['dates_' . $uniqid] as $k => $v):
					$items[$uniqid]['date'] = $v;
				endforeach;

				foreach($posts['slots_' . $uniqid] as $k => $v):
					$items[$uniqid]['slot_id'] = $v;
				endforeach;

				foreach($posts['qty_' . $uniqid] as $k => $v):
					$items[$uniqid]['quantity'] = $v;
				endforeach;

				foreach($posts['prices_' . $uniqid] as $k => $v):
					$items[$uniqid]['price'] = $v;
				endforeach;

				// I posts 'subUniqid', 'services_', 'services_prices_' e 'mandatory_', vengono messi nell'array subItems
				// per essere in seguito ciclati assieme all'id dell'events_date e popolare la tabella event_date, 
				// ed inoltre, perché in seguito verranno rimossi dal metodo _checkAllowedFields in quanto non presenti nell'array che questo metodo filtra.
				foreach($posts['subUniqid'] as $subUniqid):

					$currentUniqid = substr($subUniqid, 0, 14);

					if($currentUniqid === $uniqid):

						foreach($posts['services_' . $subUniqid] as $k => $v):
							$subItems[$uniqid]['service_id'] = $v;
						endforeach;

						foreach($posts['services_prices_' . $subUniqid] as $k => $v):
							$subItems[$uniqid]['price'] = $v;
						endforeach;

						foreach($posts['mandatory_' . $subUniqid] as $k => $v):
							$subItems[$uniqid]['mandatory'] = $v;
						endforeach;

					endif;

				endforeach;
				
			endforeach;

			// Conto le date
			$number_date = count($posts['uniqid']);

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			// Estraggo ed elimino i posts di eventuali files
			if(isset($posts['filenames']) && ! empty($posts['filenames'])):
				$filenames = $posts['filenames'];
			endif;
			unset($posts['filenames']);

			$posts['events_status'] = 2;
			$posts['events_created_at'] = date('Y-m-d H:i:s');

			// Estraggo ed elimino i meta tags
			$meta_tags = [];

			$slug = mb_url_title($posts['slug'], '-', true);

			$meta_tags['meta_tags_entity'] = $this->controller;
			$meta_tags['meta_tags_slug'] = $slug;
			$meta_tags['meta_tags_title'] = $posts['title'];
			$meta_tags['meta_tags_description'] = $posts['description'];

			unset($posts['slug'], $posts['title'], $posts['description']);

			$this->builder->insert($posts);
			$id = $this->db->insertID();

			// Inserisco i dati pertinenti nella tabella meta_tags
			$meta_tags['meta_tags_entity_id'] = $id;
			$builder = $this->db->table('meta_tags');
			$builder->insert($meta_tags);

			// Ciclo date e slots
			$date_slots = [];
			foreach($items as $k => $v):

				//die($k);

				$date_slots['event_id'] = $id; // evento
				$date_slots['date'] = $v['date']; // la data
				$date_slots['slot_id'] = $v['slot_id']; // Il tipo di slot
				$date_slots['quantity'] = $v['quantity']; // La quantità di partecipanti
				$date_slots['price'] = $v['price']; // Il prezzo di questo evento per questa data

				$builder = $this->db->table('events_date');
				$builder->insert($date_slots);
				$date_id = $this->db->insertID();

				// Ciclo services
				$services = [];
				foreach($subItems as $key => $val):

					// die($key);

					if($k == $key):

						$services[$key]['events_date_id'] = $date_id; // l'id della data dell'evento
						$services[$key]['service_id'] = $val['service_id']; // Servizio
						$services[$key]['price'] = $val['price']; // Prezzo
						$services[$key]['mandatory'] = $val['mandatory']; // Obbligatorietà

						$builder = $this->db->table('event_service');
						$builder->insertBatch($services);

					endif;

				endforeach;

			endforeach;

			// Recupero il prezzo in coins per questo evento 
			// assegnato all'organizzatore in fase di registrazione
			$builder = $this->db->table('organizer_circuit');
			$coins = $builder->select('coins')
							 ->getwhere(['organizer_id' => $posts['events_organizer_id'], 'circuit_id' => $posts['events_circuit_id'], 'type_id' => $posts['events_type_id']]);

			// Ottengo il costo totale in coins. 
			// E' la moltiplicazione fra i coins assegnati all'organizzatore
			// per questo circuito e il numero delle date per questo evento
			$cost = (int)$coins->getRow('coins') * (int)$number_date;

			// Qui risalgo all'ultimo transactions_balance dell'organizzatore in oggetto
			// ovvero quale è la sua disponibilità reale in coins
			$query = $this->db->query('select transactions_balance from transactions where transactions_organizer_id = ' . $this->db->escape($posts['events_organizer_id']) . ' and transactions_id = (select max(transactions_id) from transactions where transactions_organizer_id = ' . $this->db->escape($posts['events_organizer_id']) . ')');

			$transaction_balance = (int)$query->getRow('transactions_balance');

			// QUI BISOGNA FARE UN BEL FILTRO E CAPIRE SE L'ORGANIZZATORE HA I COINS SUFFICIENTI PER FARE TUTTO L'AMBARADAN
			// A MENO CHE NON GLI SI VOGLIA CONSENTIRE DI ANDARE IN ROSSO
			if($cost > $transaction_balance):
				return ['result' => false, 'message' => lang('backend/events.messages.balanceNotEnough')];
			endif;

			// Popolo la tabella transactions
			$transactions = [];

			$transactions['transactions_organizer_id'] = (int)$posts['events_organizer_id'];
			$transactions['transactions_reason_code'] = 4;
			$transactions['transactions_reason'] = lang('backend/transactions.form.eventWithdraw');

			// Il costo totale in coins. 
			$transactions['transactions_amount'] = $cost; 
			
			// In questo caso il secondo operando deve corrispondere a transactions_amount
			$transactions['transactions_balance'] = ($transaction_balance - $cost); 

			$transactions['transactions_created_at'] = date('Y-m-d H:i:s');

			$builder = $this->db->table('transactions');
			$builder->insert($transactions);
			$transaction_id = $this->db->insertID();

			$transEvent['transaction_id'] = $transaction_id;
			$transEvent['event_id'] = $id;
			
			$builder = $this->db->table('transaction_event');
			$builder->insert($transEvent);

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
            return ['result' => false, 'message' => lang('backend/events.messages.insertFail')];
        else:
            $this->db->transCommit();
            $event = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/events.messages.insertSuccess', [esc($event->events_name), $id])];
        endif;
	}

	public function edit(Array $posts): Array
	{
		$this->db->transBegin();

			$id = $posts[$this->primaryKey];

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			$posts['events_updated_at'] = date('Y-m-d H:i:s');

			$this->builder->update($posts, [$this->primaryKey => $id]);

			$event = $this->getID($id);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/events.messages.updateFail'), 'event' => ''];
        else:
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/events.messages.updateSuccess', [esc($event->events_name), $id]), 'event' => $event];
        endif;
	}

	public function delete(Int $id): Array
	{
		$this->db->transBegin();

			$event = $this->getID($id);

			// $builder = $this->db->table('meta_tags');
			// $builder->delete(['meta_tags_entity_id' => $id, 'meta_tags_entity' => $this->controller]);

			// $builder = $this->db->table('events_date');
			// $builder->select('id');
			// $ids = $builder->getWhere(['event_id' => $id])->getResult();
			// $builder->delete(['event_id' => $id]);

			// $builder = $this->db->table('event_service');
			// foreach($ids as $_id): 
			// 	$builder->delete(['events_date_id' => $_id->id]);
			// endforeach;

			// $builder = $this->db->table('files');
			// $builder->select('files_name');
			// $files = $builder->getWhere(['files_entity_id' => $id, 'files_entity' => $this->controller])->getResult();
			// $builder->delete(['files_entity_id' => $id, 'files_entity' => $this->controller]);

			$data = [];

			if($event->events_deleted_at == null):
				$data['events_deleted_at'] = date('Y-m-d H:i:s');
				$messageType = 'delete';
			else:
				$data['events_deleted_at'] = null;
				$messageType = 'restore';
			endif;

			// $this->builder->delete([$this->primaryKey => $id]);
			$this->builder->update($data, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/events.messages.' . $messageType . 'Fail')];
        else:
            // $this->removeImages($files);
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/events.messages.' . $messageType . 'Success', [esc($event->events_name), $id])];
        endif;
	}

	public function selectOrganizer(Int $organizer_id): String
	{
		$output = '';

		$builder = $this->db->table('circuits');
		$circuits = $builder->select('circuits_id, circuits_name, organizer_id')
							->join('organizer_circuit', 'organizer_circuit.circuit_id = circuits_id')
							->groupBy('circuits_name')
							->getWhere(['organizer_circuit.organizer_id' => $organizer_id])
							->getResult();

		$output .= '<option value="">' . lang('backend/events.form.circuitsSelect') . '</option>';

		foreach($circuits as $item):
			$output .= '<option value="' . $item->circuits_id . '">' . $item->circuits_name . '</option>';
		endforeach;

		return $output;
	}

	public function selectCircuit(Int $organizer_id, Int $circuit_id): String
	{
		$output = '';

		$builder = $this->db->table('circuits_types');
		$circuits = $builder->select('circuits_types.id, circuits_types.type')
							->join('organizer_circuit', 'organizer_circuit.type_id = circuits_types.id')
							->getWhere(['organizer_circuit.organizer_id' => $organizer_id, 'organizer_circuit.circuit_id' => $circuit_id])
							->getResult();

		$output .= '<option value="">' . lang('backend/events.form.typesSelect') . '</option>';

		foreach($circuits as $item):
			$output .= '<option value="' . $item->id . '">' . $item->type . '</option>';
		endforeach;

		return $output;
	}

	public function getAttributes(String $table, String $select): Array
	{
		$builder = $this->db->table($table);

		return $builder->select($select)->get()->getResult();
	}

	public function statusAction(Int $id, Int $status): Array
	{
		$this->db->transBegin();

			if($status == 1):
				$status = 2;
				$messageType = 'Inactive';
			else:
				$status = 1;
				$messageType = 'Active';
			endif;

			$data = [];
			$data['events_status'] = $status;
			$data['events_updated_at'] = date('Y-m-d H:i:s');

			$this->builder->where(['events_id' => (int)$id]);
			$this->builder->update($data);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/events.messages.status' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            $events = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/events.messages.status' . $messageType . 'Success', [esc($events->events_name), $id])];
        endif;
	}
}

<?php

namespace App\Models\backend;

class transactionsModel extends BackendModel
{
	protected $table = 'transactions';
	protected $primaryKey = 'transactions_id';

	protected $allowedColumns = ['transactions_id', 'organizer', 'transactions_reason_code', 'transactions_amount', 'transactions_balance'];

	protected $allowedFields = ['transactions_organizer_id', 
							   	'transactions_reason_code', 
							   	'transactions_amount'];

	protected $selectGetData = 'transactions_id, 
								(select organizers_name from organizers where organizers_id = transactions_organizer_id) as organizer,  
								transactions_reason_code, 
								transactions_reason, 
								transactions_amount, 
								transactions_balance, 
								transactions_created_at, 
								events_name';

	protected $joinGetData = [
		'transaction_event' => 'transaction_event.transaction_id = transactions.transactions_id', 
		'events' => 'events.events_id = transaction_event.event_id'
	];

	protected $selectGetID = 'transactions_id, 
							  (select organizers_name from organizers where organizers_id = transactions_organizer_id) as organizer, 
							  transactions_reason_code, 
							  transactions_reason, 
							  transactions_amount, 
							  transactions_balance, 
							  transactions_created_at, 
							  events_name';

	protected $joinGetID = [
		'transaction_event' => 'transaction_event.transaction_id = transactions.transactions_id', 
		'events' => 'events.events_id = transaction_event.event_id'
	];

	protected $controller = 'transactions';

	public $validationRules = [
		'transactions_organizer_id' => [
			'label'  => 'backend/transactions.form.organizerIdField',
			'rules'  => 'required|is_natural_no_zero'
		],  
		'transactions_reason_code' => [
			'label'  => 'backend/transactions.form.reasonCodeField',
			'rules'  => 'required|is_natural_no_zero'
		], 
		'transactions_amount' => [
			'label'  => 'backend/transactions.form.amountField',
			'rules'  => 'required|is_natural_no_zero'
		],
	];

	public $searchFields = [
	    'searchFields.transactions_id' => [
	        'rules'  => 'permit_empty|integer', 
	        'errors' => [
	            'integer' => 'backend/global.messages.integer'
	        ]
	    ]
	];

	public $searchIds = [
	    'searchIds.transactions_organizer_id' => [
	        'rules'  => 'permit_empty|is_natural_no_zero', 
	        'errors' => [
	            'is_natural_no_zero' => 'backend/global.messages.integer'
	        ]
	    ],
        'searchFields.transactions_reason_code' => [
    		'rules'  => 'permit_empty|is_natural_no_zero', 
    		'errors' => [
    		    'is_natural_no_zero' => 'backend/global.messages.integer'
    		]
    	],
	    // 'searchIds.transactions_event_id' => [
	    //     'rules'  => 'permit_empty|is_natural_no_zero', 
	    //     'errors' => [
	    //         'is_natural_no_zero' => 'backend/global.messages.integer'
	    //     ]
	    // ]
	];

	public $searchDate = [];

	public function add(Array $posts): Array
	{
		$this->db->transBegin();

			$posts = $this->_checkAllowedFields($posts, 'allowedFields'); 

			$query = $this->db->query('select transactions_balance from transactions where transactions_organizer_id = ' . $this->db->escape($posts['transactions_organizer_id']) . ' and transactions_id = (select max(transactions_id) from transactions where transactions_organizer_id = ' . $this->db->escape($posts['transactions_organizer_id']) . ')');

			if($posts['transactions_reason_code'] == 1):
				$posts['transactions_balance'] = ((int)$query->getRow('transactions_balance') + (int)$posts['transactions_amount']);
				$posts['transactions_reason'] = lang('backend/transactions.form.reasonDeposit');
			elseif($posts['transactions_reason_code'] == 2):
				$posts['transactions_balance'] = ((int)$query->getRow('transactions_balance') - (int)$posts['transactions_amount']);
				$posts['transactions_reason'] = lang('backend/transactions.form.reasonWithdraw');
			endif;

			$posts['transactions_created_at'] = date('Y-m-d H:i:s');

			$this->builder->insert($posts);
			$id = $this->db->insertID();

			$transaction = $this->getID($id);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/transactions.messages.insertFail')];
        else:
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/transactions.messages.insertSuccess', [esc($transaction->transactions_id)])];
        endif;
	}
}

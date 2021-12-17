<?php 

namespace App\Models\backend;

class ContactsModel extends BackendModel 
{
	protected $table = 'contacts';
	protected $primaryKey = 'contacts_id';

	protected $allowedColumns = ['contacts_id', 'contacts_firstname', 'contacts_lastname', 'contacts_phone', 'contacts_email'];

	protected $selectGetData = '*';
	protected $joinGetData = [];
	protected $groupByData = '';

	protected $selectGetID = '*';
	protected $joinGetID = [];

	protected $controller = 'contacts';

	public $searchFields = [
		'searchFields.contacts_id' => [
		    'rules'  => 'permit_empty|integer', 
		    'errors' => [
		        'integer' => 'backend/global.messages.integer'
		    ]
		],
		'searchFields.contacts_firstname' => [
		    'rules'  => 'permit_empty|alpha_numeric', 
		    'errors' => [
		        'alpha_numeric' => 'backend/global.messages.alpha_numeric'
		    ]
		],
		'searchFields.contacts_lastname' => [
		    'rules'  => 'permit_empty|alpha_numeric', 
		    'errors' => [
		        'alpha_numeric' => 'backend/global.messages.alpha_numeric'
		    ]
		],
		'searchFields.contacts_email' => [
		    'rules'  => 'permit_empty|alpha_numeric', 
		    'errors' => [
		        'alpha_numeric' => 'backend/global.messages.alpha_numeric'
		    ]
		],
		'searchFields.contacts_phone' => [
		    'rules'  => 'permit_empty|alpha_numeric', 
		    'errors' => [
		        'alpha_numeric' => 'backend/global.messages.alpha_numeric'
		    ]
		],
	];
	public $searchIds = [];
	public $searchDate = [];

	public function delete(Int $id): Array
	{
		$this->db->transBegin();

		$contact = $this->getID($id);

		$data = [];

		if($contact->contacts_deleted_at == null):
			$data['contacts_deleted_at'] = date('Y-m-d H:i:s');
			$messageType = 'delete';
		else:
			$data['contacts_deleted_at'] = null;
			$messageType = 'restore';
		endif;

		$this->builder->update($data, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/contacts.messages.' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/contacts.messages.' . $messageType . 'Success', [esc($contact->contacts_firstname . ' ' . $contact->contacts_lastname), $id])];
        endif;
	}
}
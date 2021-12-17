<?php 

namespace App\Models\backend;

class MembersModel extends BackendModel 
{
	protected $table = 'members';
	protected $primaryKey = 'members_id';

	protected $allowedColumns = ['members_id', 
								 'members_firstname', 
								 'members_lastname', 
								 'members_email', 
								 'members_phone', 
								 'members_status'
								];

	protected $selectGetData = 'members_id, 
								members_firstname, 
								members_lastname, 
								members_email, 
								members_phone, 
								members_status, 
								members_created_at, 
								members_updated_at, 
								members_deleted_at';

	protected $selectGetID = 'members_id, 
							  members_firstname, 
							  members_lastname, 
							  members_tax_code, 
							  members_email, 
							  members_phone, 
							  members_status, 
							  members_image, 
							  members_created_at, 
							  members_updated_at, 
							  members_deleted_at';

	protected $controller = 'members';

	public $searchFields = [
		'searchFields.members_id' => [
		    'rules'  => 'permit_empty|integer', 
		    'errors' => [
		        'integer' => 'backend/global.messages.integer'
		    ]
		],
		'searchFields.members_firstname' => [
			'rules'  => 'permit_empty|alpha_numeric', 
			'errors' => [
			    'alpha_numeric' => 'backend/global.messages.alpha_numeric'
			]
		], 
		'searchFields.members_lastname' => [
			'rules'  => 'permit_empty|alpha_numeric', 
			'errors' => [
			    'alpha_numeric' => 'backend/global.messages.alpha_numeric'
			]
		],
		'searchFields.members_email' => [
			'rules'  => 'permit_empty|alpha_numeric', 
			'errors' => [
			    'alpha_numeric' => 'backend/global.messages.alpha_numeric'
			]
		],
		'searchFields.members_phone' => [
			'rules'  => 'permit_empty|alpha_numeric', 
			'errors' => [
			    'alpha_numeric' => 'backend/global.messages.alpha_numeric'
			]
		]
	];

	public $searchIds = [];
	public $searchDate = [];

	public function delete(Int $id): Array
	{
		$this->db->transBegin();

			$member = $this->getID($id);

			$data = [];

			if($member->members_deleted_at == null):
				$data['members_deleted_at'] = date('Y-m-d H:i:s');
				$messageType = 'delete';
			else:
				$data['members_deleted_at'] = null;
				$messageType = 'restore';
			endif;

			$this->builder->update($data, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/members.messages.' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/members.messages.' . $messageType . 'Success', [esc($member->members_firstname . ' ' . $member->members_lastname), $id])];
        endif;
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
			$data['members_status'] = $status;
			$data['members_updated_at'] = date('Y-m-d H:i:s');

			$this->builder->where(['members_id' => (int)$id]);
			$this->builder->update($data);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/members.messages.status' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            $member = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/members.messages.status' . $messageType . 'Success', [esc($member->members_firstname . ' ' . $member->members_lastname), $id])];
        endif;
	}
}
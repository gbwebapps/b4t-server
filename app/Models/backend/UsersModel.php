<?php 

namespace App\Models\backend;

use App\Libraries\Token;

class UsersModel extends BackendModel 
{
	protected $table = 'users';
	protected $primaryKey = 'users_id';

	protected $allowedColumns = ['users_id', 
								 'users_firstname', 
								 'users_lastname', 
								 'users_email', 
								 'users_phone', 
								 'users_status'];

	protected $allowedFields = ['users_id', 
								'users_firstname', 
								'users_lastname', 
								'users_email', 
								'users_phone', 
								'users_role', 
								'users_image'];

	protected $selectGetData = 'users_id, 
								users_firstname, 
								users_lastname, 
								users_email, 
								users_phone, 
								users_master, 
								users_image, 
								users_status, 
								users_role, 
								users_created_at, 
								users_updated_at, 
								users_deleted_at';

	protected $selectGetID = 'users_id, 
							  users_firstname, 
							  users_lastname, 
							  users_email, 
							  users_phone, 
							  users_master, 
							  users_status, 
							  users_role, 
							  users_image, 
							  users_created_at, 
							  users_updated_at, 
							  users_deleted_at';

	protected $controller = 'users';

	public $validationRules = [
		// qui metti users_id in seguito per edit
		'users_firstname' => [
			'label'  => 'backend/users.form.firstnameField',
			'rules'  => 'required'
		], 
		'users_lastname' => [
			'label'  => 'backend/users.form.lastnameField',
			'rules'  => 'required'
		],
		'users_email' => [
			'label'  => 'backend/users.form.emailField',
			'rules'  => 'valid_email|is_unique[users.users_email,users_id,{users_id}]'
		],
		'users_phone' => [
			'label'  => 'backend/users.form.phoneField',
			'rules'  => 'required|is_unique[users.users_phone,users_id,{users_id}]'
		],
		'users_role' => [
			'label'  => 'backend/users.form.roleField',
			'rules'  => 'required|is_natural_no_zero'
		], 
		'users_image' => [
			'label' => 'Image',
			'rules' => 'is_image[users_image]|max_size[users_image,10240]|ext_in[users_image,jpg,gif,png]|max_dims[users_image,5760,3240]'
		]
	];

	public $searchFields = [
		'searchFields.users_id' => [
		    'rules'  => 'permit_empty|integer', 
		    'errors' => [
		        'integer' => 'backend/global.messages.integer'
		    ]
		],
		'searchFields.users_firstname' => [
			'rules'  => 'permit_empty|alpha_numeric', 
			'errors' => [
			    'alpha_numeric' => 'backend/global.messages.alpha_numeric'
			]
		], 
		'searchFields.users_lastname' => [
			'rules'  => 'permit_empty|alpha_numeric', 
			'errors' => [
			    'alpha_numeric' => 'backend/global.messages.alpha_numeric'
			]
		],
		'searchFields.users_email' => [
			'rules'  => 'permit_empty|alpha_numeric', 
			'errors' => [
			    'alpha_numeric' => 'backend/global.messages.alpha_numeric'
			]
		],
		'searchFields.users_phone' => [
			'rules'  => 'permit_empty|alpha_numeric', 
			'errors' => [
			    'alpha_numeric' => 'backend/global.messages.alpha_numeric'
			]
		]
	];

	public $searchIds = [];
	public $searchDate = [];

	public $accountRules = [
		// qui metti users_id in seguito per edit
		'users_firstname' => [
			'label'  => 'backend/users.form.firstnameField',
			'rules'  => 'required'
		], 
		'users_lastname' => [
			'label'  => 'backend/users.form.lastnameField',
			'rules'  => 'required'
		],
		'users_email' => [
			'label'  => 'backend/users.form.emailField',
			'rules'  => 'valid_email|is_unique[users.users_email,users_id,{users_id}]'
		],
		'users_phone' => [
			'label'  => 'backend/users.form.phoneField',
			'rules'  => 'required|is_unique[users.users_phone,users_id,{users_id}]'
		]
	];

	public function add(Array $posts): Array
	{
		$this->db->transBegin();

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			$token = new Token();
			$activationHash = $token->getHash();

			$posts['users_master'] = 2;
			$posts['users_created_at'] = date('Y-m-d H:i:s');
			$posts['users_activation_hash'] = $activationHash;
			$posts['users_activation_expire'] = date('Y-m-d H:i:s', time() + 43200); // 12 hours

			$this->builder->insert($posts);
			$id = $this->db->insertID();

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/users.messages.insertFail')];
        else:
            $this->db->transCommit();
            $user = $this->getID($id);

            $params = [
            	'to' => esc($user->users_email), 
            	'subject' => 'Registration account ' . esc($user->users_firstname) . ' ' . esc($user->users_lastname), 
            	'firstname' => esc($user->users_firstname), 
            	'lastname' => esc($user->users_lastname), 
            	'email' => esc($user->users_email), 
            	'token' => $token->getValue(), 
            	'controller' => 'users', 
            	'action' => 'activation', 
        	];

        	if( ! $this->sendEmail($params)):
        		$message = lang('backend/users.messages.insertNoMailSuccess', [esc($user->users_firstname . ' ' . $user->users_lastname), $id]);
        	else:
        		$message = lang('backend/users.messages.insertSuccess', [esc($user->users_firstname . ' ' . $user->users_lastname), $id]);
        	endif;
            
            return ['result' => true, 'message' => $message];
        endif;
	}

	public function edit(Array $posts): Array
	{
		$this->db->transBegin();

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			$id = (int)$posts[$this->primaryKey];

			$posts['users_updated_at'] = date('Y-m-d H:i:s');

			$user = $this->getID($id); // raccolta dati per recuperare users_image
			if(isset($posts['users_image']) && ! empty($posts['users_image'])):
				if($user->users_image):
					$this->removeImages($user->users_image);
				endif;
			endif;

			$this->builder->update($posts, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/users.messages.updateFail'), 'user' => null];
        else:
            $this->db->transCommit();
            $user = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/users.messages.updateSuccess', [esc($user->users_firstname . ' ' . $user->users_lastname), $id]), 'user' => $user];
        endif;
	}

	public function delete(Int $id): Array
	{
		$this->db->transBegin();

			$user = $this->getID($id);

			// if( ! is_null($user->users_image)):
			// 	$this->removeImages($user->users_image);
			// endif;

			$data = [];

			if($user->users_deleted_at == null):
				$data['users_deleted_at'] = date('Y-m-d H:i:s');
				$messageType = 'delete';
			else:
				$data['users_deleted_at'] = null;
				$messageType = 'restore';
			endif;

			// $this->builder->delete([$this->primaryKey => $id]);
			$this->builder->update($data, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/users.messages.' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/users.messages.' . $messageType . 'Success', [esc($user->users_firstname) . ' ' . esc($user->users_lastname), $id])];
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
			$data['users_status'] = $status;
			$data['users_updated_at'] = date('Y-m-d H:i:s');

			$this->builder->where(['users_id' => (int)$id]);
			$this->builder->update($data);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/users.messages.status' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            $user = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/users.messages.status' . $messageType . 'Success', [esc($user->users_firstname) . ' ' . esc($user->users_lastname), $id])];
        endif;
	}

	public function roleAction(Int $id, Int $role): Array
	{
		$this->db->transBegin();

			if($role == 1):
				$role = 2;
				$messageType = 'Editor';
			else:
				$role = 1;
				$messageType = 'Admin';
			endif;

			$data = [];
			$data['users_role'] = $role;
			$data['users_updated_at'] = date('Y-m-d H:i:s');

			$this->builder->where(['users_id' => (int)$id]);
			$this->builder->update($data);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/users.messages.role' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            $user = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/users.messages.role' . $messageType . 'Success', [esc($user->users_firstname) . ' ' . esc($user->users_lastname), $id])];
        endif;
	}

	public function getProfile(String $users_id)
	{
		$user = $this->builder->limit(1)->getWhere(['users_id' => $users_id]);

		if($user->getNumRows() > 0):
			return $user->getRow();
		endif;

		return false;
	}

	public function removeAvatar(Int $user_id): Array
	{
		$this->db->transBegin();

		$file = $this->builder->select('users_image')->where(['users_id' => $user_id])->get()->getRow('users_image');

		$data['users_image'] = null;
		$data['users_updated_at'] = date('Y-m-d H:i:s');

		$this->builder->where(['users_id' => $user_id])->update($data);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/global.messages.ImageRemoveFail')];
        else:
            $this->db->transCommit();
            $this->removeImages($file);
            $user = $this->getID($user_id);
            return ['result' => true, 
            		'message' => lang('backend/global.messages.ImageRemoveSuccess'), 
            		'user' => $user, 
            	];
        endif;
	}

	public function resetPassword(Int $id)
	{
		$this->db->transBegin();

			$token = new Token();
			$activationHash = $token->getHash();

			$data = [];
			$data['users_updated_at'] = date('Y-m-d H:i:s');
			$data['users_activation_hash'] = $activationHash;
			$data['users_activation_expire'] = date('Y-m-d H:i:s', time() + 43200); // 12 hours
			$data['users_password_hash'] = null;

			$this->builder->update($data, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/global.messages.resetPasswordFail')];
        else:
            $this->db->transCommit();
            $user = $this->getID($id);

            $params = [
            	'to' => esc($user->users_email), 
            	'subject' => 'Reset password ' . esc($user->users_firstname) . ' ' . esc($user->users_lastname), 
            	'firstname' => esc($user->users_firstname), 
            	'lastname' => esc($user->users_lastname), 
            	'email' => esc($user->users_email), 
            	'token' => $token->getValue(), 
            	'controller' => 'users', 
            	'action' => 'reset', 
        	];

        	if( ! $this->sendEmail($params)):
        		$message = lang('backend/users.messages.resetNoMailSuccess', [esc($user->users_firstname . ' ' . $user->users_lastname), $id]);
        	else:
        		$message = lang('backend/users.messages.resetSuccess', [esc($user->users_firstname . ' ' . $user->users_lastname), $id]);
        	endif;
            
            return ['result' => true, 'message' => $message];
        endif;
	}
}
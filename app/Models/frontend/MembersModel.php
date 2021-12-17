<?php 

namespace App\Models\frontend;

use App\Libraries\Token;

class MembersModel extends FrontendModel 
{
	protected $table = 'members';
	protected $primaryKey = 'members_id';

	protected $allowedLoginFields = ['members_email', 'members_password', 'members_remember_me'];

	protected $allowedRecoveryFields = ['members_email'];

	protected $allowedRegisterFields = ['members_firstname', 
										'members_lastname', 
										'members_address', 
										'members_tax_code', 
										'members_email', 
										'members_phone'];

	protected $allowedSetPasswordFields = ['members_password', 'members_confirmation_password', 'members_code'];

	protected $selectGetID = 'members_id, 
							  members_firstname, 
							  members_lastname, 
							  members_address, 
							  members_tax_code, 
							  members_email, 
							  members_phone, 
							  members_image';

	protected $controller = 'members';

	public $registerRules = [
		'members_firstname' => [
			'label'  => 'frontend/members.form.firstname',
			'rules'  => 'required'
		], 
		'members_lastname' => [
			'label'  => 'frontend/members.form.lastname',
			'rules'  => 'required'
		],
		'members_address' => [
			'label'  => 'frontend/members.form.address',
			'rules'  => 'required'
		], 
		'members_tax_code' => [
			'label'  => 'frontend/members.form.tax_code',
			'rules'  => 'required'
		],
		'members_email' => [
			'label'  => 'frontend/members.form.email',
			'rules'  => 'required|valid_email|is_unique[members.members_email,members_id,{members_id}]'
		],
		'members_phone' => [
			'label'  => 'frontend/members.form.phone',
			'rules'  => 'required|is_unique[members.members_phone,members_id,{members_id}]'
		]
	];

	public $setPasswordRules = [
		'members_code' => [
			'label'  => 'frontend/members.form.membersCodeField',
			'rules'  => 'required|alpha_numeric|checkMemberActivation'
		], 
		'members_password' => [
			'label'  => 'frontend/members.form.newPasswordField',
			'rules'  => 'required|alpha_numeric'
		],
		'members_confirmation_password' => [
			'label'  => 'frontend/members.form.confirmationPasswordField',
			'rules'  => 'required|matches[members_password]'
		]
	];

	public $loginRules = [
		'members_email' => [
			'label'  => 'frontend/members.form.email',
			'rules'  => 'required|valid_email|is_not_unique[members.members_email.{members_email}]', 
			'errors' => [
				'is_not_unique' => 'frontend/members.messages.errorCheckEmail', 
			]
		], 
		'members_password' => [
			'label'  => 'frontend/members.form.password',
			'rules'  => 'required|alpha_numeric'
		]
	];

	public $recoveryRules = [
		'members_email' => [
			'label'  => 'frontend/members.form.email',
			'rules'  => 'required|valid_email|is_not_unique[members.members_email.{members_email}]', 
			'errors' => [
				'is_not_unique' => 'frontend/members.messages.errorCheckEmail', 
			]
		]
	];

	public function login(Array $posts): Array
	{
		$posts = $this->_checkAllowedFields($posts, 'allowedLoginFields');

		$members_remember_me = (isset($posts['members_remember_me']) ? (bool)$posts['members_remember_me'] : false);

		$where = ['members_email' => $posts['members_email'], 'members_status' => 1, 'members_deleted_at' => null];

		$query = $this->builder->select('members_id, members_password_hash')->limit(1)->getWhere($where);

		if(password_verify($posts['members_password'], $query->getRow('members_password_hash'))):

			if($members_remember_me):

				$token = new Token();
				$sessions_token_hash = $token->getHash();
				$sessions_expires_at = date('Y-m-d H:i:s', time() + 864000); // 10 giorni

				$builder = $this->db->table('sessions');
				$builder->insert(['sessions_token_hash' => $sessions_token_hash, 
								  'sessions_entity_id' => $query->getRow('members_id'), 
								  'sessions_entity' => 'members', 
								  'sessions_expires_at' => $sessions_expires_at]);

				$response = service('response');
				$response->setCookie('members_remember_me', $token->getValue(), $sessions_expires_at);

			else:

				$members_backend_session = random_string('sha1');

				$token = new Token($members_backend_session);
				$members_token_hash = $token->getHash();

				$data = ['members_token_hash' => $members_token_hash];

				$this->builder->update($data, $where);

				$session = session();
				$session->regenerate();
				$session->set(['members_backend_session' => $members_backend_session]);

			endif;

			return ['result' => true];

		endif;

		return ['result' => false, 'message' => lang('frontend/members.messages.loginFail')];
	}

	public function recovery(Array $posts): Array
	{
		$posts = $this->_checkAllowedFields($posts, 'allowedRecoveryFields');

		$where = ['members_email' => $posts['members_email'], 'members_deleted_at' => null];

		if($member = $this->builder->select('*')->limit(1)->getWhere($where)):

			$token = new Token();
			$activationHash = $token->getHash();

			$this->builder->where($where)->update(['members_activation_hash' => $activationHash, 'members_activation_expire' => date('Y-m-d H:i:s', time() + 43200)]); // 12 ore

		    $params = [
		    	'to' => esc($member->getRow('members_email')), 
		    	'subject' => 'Recovery password ' . esc($member->getRow('members_firstname')) . ' ' . esc($member->getRow('members_lastname')), 
		    	'firstname' => esc($member->getRow('members_firstname')), 
		    	'lastname' => esc($member->getRow('members_lastname')), 
		    	'email' => esc($member->getRow('members_email')), 
		    	'token' => $token->getValue(), 
		    	'controller' => 'members', 
		    	'action' => 'recovery', 
			];

			if( ! $this->sendEmail($params)):
				$message = lang('frontend/members.messages.recoveryNoMailSuccess', 
					[esc($member->getRow('members_firstname')) . ' ' . esc($member->getRow('members_lastname')), $member->getRow('members_id')]);
			else:
				$message = lang('frontend/members.messages.recoverySuccess', 
					[esc($member->getRow('members_firstname')) . ' ' . esc($member->getRow('members_lastname')), $member->getRow('members_id')]);
			endif;

			return ['result' => true, 'message' => $message];

		endif;

		return ['result' => false, 'message' => lang('frontend/members.messages.recoveryFail')];
	}

	public function register(Array $posts): Array
	{
		$this->db->transBegin();

			$posts = $this->_checkAllowedFields($posts, 'allowedRegisterFields');

			$token = new Token();
			$activationHash = $token->getHash();

			$posts['members_created_at'] = date('Y-m-d H:i:s');
			$posts['members_activation_hash'] = $activationHash;
			$posts['members_activation_expire'] = date('Y-m-d H:i:s', time() + 43200); // 12 hours

			$this->builder->insert($posts);
			$id = $this->db->insertID();

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('frontend/members.messages.registerFail')];
        else:
            $this->db->transCommit();
            $member = $this->getID($id);

            $params = [
            	'to' => esc($member->members_email), 
            	'subject' => 'Registration Member ' . esc($member->members_firstname) . ' ' . esc($member->members_lastname), 
            	'firstname' => esc($member->members_firstname), 
            	'lastname' => esc($member->members_lastname), 
            	'email' => esc($member->members_email), 
            	'token' => $token->getValue(), 
            	'controller' => 'members', 
            	'action' => 'registration', 
        	];

    		if( ! $this->sendEmail($params)):
    			$message = lang('frontend/members.messages.registerNoMailSuccess', [esc($member->members_firstname . ' ' . $member->members_lastname), $id]);
    		else:
    			$message = lang('frontend/members.messages.registerSuccess', [esc($member->members_firstname . ' ' . $member->members_lastname), $id]);
    		endif;
    	    
    	    return ['result' => true, 'message' => $message];
        endif;
	}

	public function setPassword(Array $posts): Array
	{
		$posts = $this->_checkAllowedFields($posts, 'allowedSetPasswordFields');

		if( ! $this->checkAuthCode($posts['members_code'])):
			return ['result' => false, 'message' => lang('frontend/members.messages.setPasswordFail')];
		endif;

		$token = new Token($posts['members_code']);
		$hash = $token->getHash();

		$where = ['members_activation_hash' => $hash, 'members_deleted_at' => null];

		$query = $this->builder->select('members_firstname, members_lastname')->limit(1)->getWhere($where);

		$data = ['members_password_hash' => password_hash($posts['members_password'], PASSWORD_DEFAULT), 
														'members_status' => '1', 
														'members_activation_hash' => null, 
														'members_activation_expire' => null];

		if ($this->builder->update($data, $where)):

			return ['result' => true, 'message' => lang('frontend/members.messages.setPasswordSuccess', 
				[esc($query->getRow('members_firstname')), esc($query->getRow('members_lastname'))])];

		endif;

		return ['result' => false, 'message' => lang('frontend/members.messages.setPasswordFail')];
	}

	public function checkAuthCode(String $token): Bool
	{
		$token = new Token($token);
		$activationHash = $token->getHash();

		$query = $this->builder->limit(1)->getWhere(['members_activation_hash' => $activationHash, 'members_deleted_at' => null]);

		if(($query->getNumRows() > 0) && (date('Y-m-d H:i:s') < $query->getRow('members_activation_expire'))):
			return true;
		endif;

		return false;
	}

	public function logoutBySession()
	{
		$token = new Token(session('members_backend_session'));
		$members_token_hash = $token->getHash();

		$where = ['members_token_hash' => $members_token_hash];

		$this->builder->where($where)->update(['members_token_hash' => null]);

		session()->destroy();
	}

	public function logoutByCookie($cookie)
	{
		$builder = $this->db->table('sessions');

		$token = new Token($cookie);
		$hash = $token->getHash();

		$where = ['sessions_token_hash' => $hash, 'sessions_entity' => 'members']; // mettere anche l'id del member corrente

		$builder->where($where)->delete();

		$response = service('response');
		$response->deleteCookie('members_remember_me');
	}
}
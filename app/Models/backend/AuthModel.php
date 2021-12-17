<?php 

namespace App\Models\backend;

use App\Libraries\Token;

class AuthModel extends BackendModel {

	protected $table = 'users';
	protected $primaryKey = 'users_id';

	protected $allowedLoginFields = ['users_email', 'users_password', 'users_remember_me'];
	protected $allowedRecoveryFields = ['users_email'];
	protected $allowedSetPasswordFields = ['users_password', 'users_confirmation_password', 'users_code'];

	protected $controller = 'auth';

	public $loginRules = [
		'users_email' => [
			'label'  => 'backend/auth.form.emailField',
			'rules'  => 'required|valid_email|is_not_unique[users.users_email.{users_email}]', 
			'errors' => [
				'is_not_unique' => 'backend/auth.messages.errorCheckEmail',
			]
		], 
		'users_password' => [
			'label'  => 'backend/auth.form.passwordField',
			'rules'  => 'required|alpha_numeric'
		]
	];

	public $recoveryRules = [
		'users_email' => [
			'label'  => 'backend/auth.form.emailField',
			'rules'  => 'required|valid_email|is_not_unique[users.users_email.{users_email}]', 
			'errors' => [
				'is_not_unique' => 'backend/auth.messages.errorCheckEmail',
			]
		]
	];

	public $setPasswordRules = [
		'users_code' => [
			'label'  => 'backend/auth.form.authCodeField',
			'rules'  => 'required|alpha_numeric|checkActivationCode'
		], 
		'users_password' => [
			'label'  => 'backend/auth.form.newPasswordField',
			'rules'  => 'required|alpha_numeric'
		],
		'users_confirmation_password' => [
			'label'  => 'backend/auth.form.confirmationPasswordField',
			'rules'  => 'required|matches[users_password]'
		]
	];

	public function login(Array $posts): Array
	{
		$posts = $this->_checkAllowedFields($posts, 'allowedLoginFields');

		$users_remember_me = (isset($posts['users_remember_me']) ? (bool)$posts['users_remember_me'] : false);

		$where = ['users_email' => $posts['users_email'], 'users_status' => 1, 'users_deleted_at' => null];

		$query = $this->builder->select('users_id, users_password_hash')->limit(1)->getWhere($where);

		if(password_verify($posts['users_password'], $query->getRow('users_password_hash'))):

			if($users_remember_me):

				$token = new Token();
				$sessions_token_hash = $token->getHash();
				$sessions_expires_at = date('Y-m-d H:i:s', time() + 864000); // 10 giorni

				$builder = $this->db->table('sessions');
				$builder->insert(['sessions_token_hash' => $sessions_token_hash, 
								  'sessions_entity_id' => $query->getRow('users_id'), 
								  'sessions_entity' => 'users', 
								  'sessions_expires_at' => $sessions_expires_at]);

				$response = service('response');
				$response->setCookie('users_remember_me', $token->getValue(), $sessions_expires_at);

			else:

				$users_backend_session = random_string('sha1');

				$token = new Token($users_backend_session);
				$users_token_hash = $token->getHash();

				$data = ['users_token_hash' => $users_token_hash];

				$this->builder->update($data, $where);

				$session = session();
				$session->regenerate();
				$session->set(['users_backend_session' => $users_backend_session]);

			endif;

			return ['result' => true];

		endif;

		return ['result' => false, 'message' => lang('backend/auth.messages.loginFail')];
	}

	public function recovery(Array $posts): Array
	{
		$posts = $this->_checkAllowedFields($posts, 'allowedRecoveryFields');

		$where = ['users_email' => $posts['users_email'], 'users_deleted_at' => null];

		if($user = $this->builder->select('*')->limit(1)->getWhere($where)):

			$token = new Token();
			$activationHash = $token->getHash();

			$this->builder->where($where)->update(['users_activation_hash' => $activationHash, 'users_activation_expire' => date('Y-m-d H:i:s', time() + 43200)]); // 12 ore

		    $params = [
		    	'to' => esc($user->getRow('users_email')), 
		    	'subject' => 'Recovery password ' . esc($user->getRow('users_firstname')) . ' ' . esc($user->getRow('users_lastname')), 
		    	'firstname' => esc($user->getRow('users_firstname')), 
		    	'lastname' => esc($user->getRow('users_lastname')), 
		    	'email' => esc($user->getRow('users_email')), 
		    	'token' => $token->getValue(), 
		    	'controller' => 'auth', 
		    	'action' => 'recovery', 
			];

			if( ! $this->sendEmail($params)):
				$message = lang('backend/auth.messages.recoveryNoMailSuccess', 
					[esc($user->getRow('users_firstname')) . ' ' . esc($user->getRow('users_lastname')), $user->getRow('users_id')]);
			else:
				$message = lang('backend/auth.messages.recoverySuccess', 
					[esc($user->getRow('users_firstname')) . ' ' . esc($user->getRow('users_lastname')), $user->getRow('users_id')]);
			endif;

			return ['result' => true, 'message' => $message];

		endif;

		return ['result' => false, 'message' => lang('backend/auth.messages.recoveryFail')];
	}

	public function setPassword(Array $posts): Array
	{
		$posts = $this->_checkAllowedFields($posts, 'allowedSetPasswordFields');

		if( ! $this->checkAuthCode($posts['users_code'])):
			return ['result' => false, 'message' => lang('backend/auth.messages.setPasswordFail')];
		endif;

		$token = new Token($posts['users_code']);
		$hash = $token->getHash();

		$where = ['users_activation_hash' => $hash, 'users_deleted_at' => null];

		$query = $this->builder->select('users_firstname, users_lastname')->limit(1)->getWhere($where);

		$data = ['users_password_hash' => password_hash($posts['users_password'], PASSWORD_DEFAULT), 
														'users_status' => '1', 
														'users_activation_hash' => null, 
														'users_activation_expire' => null];

		if ($this->builder->update($data, $where)):

			return ['result' => true, 'message' => lang('backend/auth.messages.setPasswordSuccess', 
				[esc($query->getRow('users_firstname')), esc($query->getRow('users_lastname'))])];

		endif;

		return ['result' => false, 'message' => lang('backend/auth.messages.setPasswordFail')];
	}

	public function checkAuthCode(String $token): Bool
	{
		$token = new Token($token);
		$activationHash = $token->getHash();

		$query = $this->builder->limit(1)->getWhere(['users_activation_hash' => $activationHash, 'users_deleted_at' => null]);

		if(($query->getNumRows() > 0) && (date('Y-m-d H:i:s') < $query->getRow('users_activation_expire'))):
			return true;
		endif;

		return false;
	}

	public function logoutBySession()
	{
		$token = new Token(session('users_backend_session'));
		$users_token_hash = $token->getHash();

		$where = ['users_token_hash' => $users_token_hash];

		$this->builder->where($where)->update(['users_token_hash' => null]);

		session()->destroy();
	}

	public function logoutByCookie($cookie)
	{
		$builder = $this->db->table('sessions');

		$token = new Token($cookie);
		$hash = $token->getHash();

		$where = ['sessions_token_hash' => $hash, 'sessions_entity' => 'users']; // mettere anche l'id dell'user corrente

		$builder->where($where)->delete();

		$response = service('response');
		$response->deleteCookie('users_remember_me');
	}

}
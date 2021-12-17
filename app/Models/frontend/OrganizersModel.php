<?php 

namespace App\Models\frontend;

use App\Libraries\Token;

class OrganizersModel extends FrontendModel 
{
	protected $table = 'organizers';
	protected $primaryKey = 'organizers_id';

	protected $allowedLoginFields = ['organizers_email', 'organizers_password', 'organizers_remember_me'];

	protected $allowedRecoveryFields = ['organizers_email'];

	protected $allowedRegisterFields = ['organizers_name', 
										'organizers_address', 
										'organizers_tax_code', 
										'organizers_email', 
										'organizers_phone'];

	protected $allowedSetPasswordFields = ['organizers_password', 'organizers_confirmation_password', 'organizers_code'];

	protected $selectGetData = 'organizers_id, 
								organizers_name, 
								organizers_short_description, 
								organizers_created_at, 
								(select meta_tags_slug from meta_tags where meta_tags_entity = "organizers" and meta_tags_entity_id = organizers_id) as meta_tags_slug, 
								(select files_name from files where files_entity = "organizers" and files_entity_id = organizers_id and files_is_cover = "1") as files_name';

	protected $whereData = ['organizers_deleted_at' => null];
								
	protected $groupByData = ['organizers_id'];

	protected $selectGetID = 'organizers_id, 
							  organizers_name, 
							  organizers_address, 
							  organizers_tax_code, 
							  organizers_email, 
							  organizers_phone, 
							  organizers_image';

	protected $controller = 'organizers';

	public $setPasswordRules = [
		'organizers_code' => [
			'label'  => 'frontend/organizers.form.organizersCodeField',
			'rules'  => 'required|alpha_numeric|checkOrganizerActivation'
		], 
		'organizers_password' => [
			'label'  => 'frontend/organizers.form.newPasswordField',
			'rules'  => 'required|alpha_numeric'
		],
		'organizers_confirmation_password' => [
			'label'  => 'frontend/organizers.form.confirmationPasswordField',
			'rules'  => 'required|matches[organizers_password]'
		]
	];

	public $loginRules = [
		'organizers_email' => [
			'label'  => 'frontend/organizers.form.email',
			'rules'  => 'required|valid_email|is_not_unique[organizers.organizers_email.{organizers_email}]', 
			'errors' => [
				'is_not_unique' => 'frontend/organizers.messages.errorCheckEmail', 
			]
		], 
		'organizers_password' => [
			'label'  => 'frontend/organizers.form.password',
			'rules'  => 'required|alpha_numeric'
		]
	];

	public $recoveryRules = [
		'organizers_email' => [
			'label'  => 'frontend/organizers.form.email',
			'rules'  => 'required|valid_email|is_not_unique[organizers.organizers_email.{organizers_email}]', 
			'errors' => [
				'is_not_unique' => 'frontend/organizers.messages.errorCheckEmail', 
			]
		]
	];

	public $searchFields = [
		'searchFields.organizers_name' => [
	        'rules'  => 'permit_empty|alpha', 
	        'errors' => [
	            'alpha' => 'backend/global.messages.alpha'
	        ]
	    ],
	];

	public function login(Array $posts): Array
	{
		$posts = $this->_checkAllowedFields($posts, 'allowedLoginFields');

		$organizers_remember_me = (isset($posts['organizers_remember_me']) ? (bool)$posts['organizers_remember_me'] : false);

		$where = ['organizers_email' => $posts['organizers_email'], 'organizers_deleted_at' => null];

		$query = $this->builder->select('organizers_id, organizers_password_hash')->limit(1)->getWhere($where);

		if(password_verify($posts['organizers_password'], $query->getRow('organizers_password_hash'))):

			if($organizers_remember_me):

				$token = new Token();
				$sessions_token_hash = $token->getHash();
				$sessions_expires_at = date('Y-m-d H:i:s', time() + 864000); // 10 giorni

				$builder = $this->db->table('sessions');
				$builder->insert(['sessions_token_hash' => $sessions_token_hash, 
								  'sessions_entity_id' => $query->getRow('organizers_id'), 
								  'sessions_entity' => 'organizers', 
								  'sessions_expires_at' => $sessions_expires_at]);

				$response = service('response');
				$response->setCookie('organizers_remember_me', $token->getValue(), $sessions_expires_at);

			else:

				$organizers_backend_session = random_string('sha1');

				$token = new Token($organizers_backend_session);
				$organizers_token_hash = $token->getHash();

				$data = ['organizers_token_hash' => $organizers_token_hash];

				$this->builder->update($data, $where);

				$session = session();
				$session->regenerate();
				$session->set(['organizers_backend_session' => $organizers_backend_session]);

			endif;

			return ['result' => true];

		endif;

		return ['result' => false, 'message' => lang('frontend/organizers.messages.loginFail')];
	}

	public function recovery(Array $posts): Array
	{
		$posts = $this->_checkAllowedFields($posts, 'allowedRecoveryFields');

		$where = ['organizers_email' => $posts['organizers_email'], 'organizers_deleted_at' => null];

		if($organizer = $this->builder->select('*')->limit(1)->getWhere($where)):

			$token = new Token();
			$activationHash = $token->getHash();

			$this->builder->where($where)->update(['organizers_activation_hash' => $activationHash, 'organizers_activation_expire' => date('Y-m-d H:i:s', time() + 43200)]); // 12 ore

		    $params = [
		    	'to' => esc($organizer->getRow('organizers_email')), 
		    	'subject' => 'Recovery password ' . esc($organizer->getRow('organizers_name')), 
		    	'firstname' => esc($organizer->getRow('organizers_name')), 
		    	'email' => esc($organizer->getRow('organizers_email')), 
		    	'token' => $token->getValue(), 
		    	'controller' => 'organizers', 
		    	'action' => 'recovery', 
			];

			if( ! $this->sendEmail($params)):
				$message = lang('frontend/organizers.messages.recoveryNoMailSuccess', 
					[esc($organizer->getRow('organizers_name')), $organizer->getRow('organizers_id')]);
			else:
				$message = lang('frontend/organizers.messages.recoverySuccess', 
					[esc($organizer->getRow('organizers_name')), $organizer->getRow('organizers_id')]);
			endif;

			return ['result' => true, 'message' => $message];

		endif;

		return ['result' => false, 'message' => lang('frontend/organizers.messages.recoveryFail')];
	}

	public function setPassword(Array $posts): Array
	{
		$posts = $this->_checkAllowedFields($posts, 'allowedSetPasswordFields');

		if( ! $this->checkAuthCode($posts['organizers_code'])):
			return ['result' => false, 'message' => lang('frontend/organizers.messages.setPasswordFail')];
		endif;

		$token = new Token($posts['organizers_code']);
		$hash = $token->getHash();

		$where = ['organizers_activation_hash' => $hash, 'organizers_deleted_at' => null];

		$query = $this->builder->select('organizers_name')->limit(1)->getWhere($where);

		$data = ['organizers_password_hash' => password_hash($posts['organizers_password'], PASSWORD_DEFAULT), 
														'organizers_activation_hash' => null, 
														'organizers_activation_expire' => null];

		if ($this->builder->update($data, $where)):

			return ['result' => true, 'message' => lang('frontend/organizers.messages.setPasswordSuccess', 
				[esc($query->getRow('organizers_name'))])];

		endif;

		return ['result' => false, 'message' => lang('frontend/organizers.messages.setPasswordFail')];
	}

	public function checkAuthCode(String $token): Bool
	{
		$token = new Token($token);
		$activationHash = $token->getHash();

		$query = $this->builder->limit(1)->getWhere(['organizers_activation_hash' => $activationHash, 'organizers_deleted_at' => null]);

		if(($query->getNumRows() > 0) && (date('Y-m-d H:i:s') < $query->getRow('organizers_activation_expire'))):
			return true;
		endif;

		return false;
	}

	public function logoutBySession()
	{
		$token = new Token(session('organizers_backend_session'));
		$organizers_token_hash = $token->getHash();

		$where = ['organizers_token_hash' => $organizers_token_hash];

		$this->builder->where($where)->update(['organizers_token_hash' => null]);

		session()->destroy();
	}

	public function logoutByCookie($cookie)
	{
		$builder = $this->db->table('sessions');

		$token = new Token($cookie);
		$hash = $token->getHash();

		$where = ['sessions_token_hash' => $hash, 'sessions_entity' => 'organizers']; // mettere anche l'id del organizer corrente

		$builder->where($where)->delete();

		$response = service('response');
		$response->deleteCookie('organizers_remember_me');
	}

}
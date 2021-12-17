<?php 

namespace App\Libraries;

use App\Libraries\Token;

class AuthorizationOrganizersManager {

	private $db;

	public function __construct()
	{
		$this->db = db_connect();
	}

	public function isLoggedIn()
	{
		if($organizer = $this->getOrganizerFromSession()):
			return $organizer;
		endif;

		if($organizer = $this->getOrganizerFromCookie()):
			return $organizer;
		endif;

		return false;
	}

	private function getOrganizerFromSession()
	{
		if(( ! session('organizers_backend_session')) || (session('organizers_backend_session') == '')):
			return false;
		endif;

		$token = new Token(session('organizers_backend_session'));
		$organizers_token_hash = $token->getHash();

		$organizer = $this->getCurrentOrganizer(['organizers_token_hash' => $organizers_token_hash, 
											     'organizers_deleted_at' => null]);

		if($organizer): return $organizer; endif;

		return false;
	}

	private function getOrganizerFromCookie()
	{
		$request = service('request');

		$cookie = $request->getCookie('organizers_remember_me');

		if(is_null($cookie)):
			return false;
		endif;

		$token = new Token($cookie);
		$hash = $token->getHash();

		$builder = $this->db->table('sessions');

		$where = ['sessions_token_hash' => $hash, 'sessions_entity' => 'organizers'];

		$sessions_token = $builder->select('*')->limit(1)->getWhere($where);

		if($sessions_token->getRow('sessions_token_hash') && $sessions_token->getRow('sessions_expires_at') > date('Y-m-d H:i:s')):

			$organizer = $this->getCurrentOrganizer(['organizers_id' => $sessions_token->getRow('sessions_entity_id'), 
										   			 'organizers_deleted_at' => null]);

			if($organizer): return $organizer; endif;

		endif;

		return false;
	}

	private function getCurrentOrganizer(Array $where)
	{
		$builder = $this->db->table('organizers');

		$organizer = $builder->select('*')->limit(1)->getWhere($where)->getRow();

		if($organizer):
			return $organizer;
		endif;

		return false;
	}
	
}
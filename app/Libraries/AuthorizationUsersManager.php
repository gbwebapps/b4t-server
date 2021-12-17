<?php 

namespace App\Libraries;

use App\Libraries\Token;

class AuthorizationUsersManager {

	private $db;

	public function __construct()
	{
		$this->db = db_connect();
	}

	public function isLoggedIn()
	{
		if($user = $this->getUserFromSession()):
			return $user;
		endif;

		if($user = $this->getUserFromCookie()):
			return $user;
		endif;

		return false;
	}

	private function getUserFromSession()
	{
		if(( ! session('users_backend_session')) || (session('users_backend_session') == '')):
			return false;
		endif;

		$token = new Token(session('users_backend_session'));
		$users_token_hash = $token->getHash();

		$user = $this->getCurrentUser(['users_token_hash' => $users_token_hash, 
									   'users_status' => 1, 
									   'users_deleted_at' => null]);

		if($user): return $user; endif;

		return false;
	}

	private function getUserFromCookie()
	{
		$request = service('request');

		$cookie = $request->getCookie('users_remember_me');

		if(is_null($cookie)):
			return false;
		endif;

		$token = new Token($cookie);
		$hash = $token->getHash();

		$builder = $this->db->table('sessions');

		$where = ['sessions_token_hash' => $hash, 'sessions_entity' => 'users'];

		$sessions_token = $builder->select('*')->limit(1)->getWhere($where);

		if($sessions_token->getRow('sessions_token_hash') && $sessions_token->getRow('sessions_expires_at') > date('Y-m-d H:i:s')):

			$user = $this->getCurrentUser(['users_id' => $sessions_token->getRow('sessions_entity_id'), 
										   'users_status' => 1, 
										   'users_deleted_at' => null]);

			if($user): return $user; endif;

		endif;

		return false;
	}

	private function getCurrentUser(Array $where)
	{
		$builder = $this->db->table('users');

		$user = $builder->select('*')->limit(1)->getWhere($where)->getRow();

		if($user):
			return $user;
		endif;

		return false;
	}
	
}
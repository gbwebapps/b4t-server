<?php 

namespace App\Libraries;

use App\Libraries\Token;

class AuthorizationMembersManager {

	private $db;

	public function __construct()
	{
		$this->db = db_connect();
	}

	public function isLoggedIn()
	{
		if($member = $this->getMemberFromSession()):
			return $member;
		endif;

		if($member = $this->getMemberFromCookie()):
			return $member;
		endif;

		return false;
	}

	private function getMemberFromSession()
	{
		if(( ! session('members_backend_session')) || (session('members_backend_session') == '')):
			return false;
		endif;

		$token = new Token(session('members_backend_session'));
		$members_token_hash = $token->getHash();

		$member = $this->getCurrentMember(['members_token_hash' => $members_token_hash, 
									   'members_status' => 1, 
									   'members_deleted_at' => null]);

		if($member): return $member; endif;

		return false;
	}

	private function getMemberFromCookie()
	{
		$request = service('request');

		$cookie = $request->getCookie('members_remember_me');

		if(is_null($cookie)):
			return false;
		endif;

		$token = new Token($cookie);
		$hash = $token->getHash();

		$builder = $this->db->table('sessions');

		$where = ['sessions_token_hash' => $hash, 'sessions_entity' => 'members'];

		$sessions_token = $builder->select('*')->limit(1)->getWhere($where);

		if($sessions_token->getRow('sessions_token_hash') && $sessions_token->getRow('sessions_expires_at') > date('Y-m-d H:i:s')):

			$member = $this->getCurrentMember(['members_id' => $sessions_token->getRow('sessions_entity_id'), 
										   'members_status' => 1, 
										   'members_deleted_at' => null]);

			if($member): return $member; endif;

		endif;

		return false;
	}

	private function getCurrentMember(Array $where)
	{
		$builder = $this->db->table('members');

		$member = $builder->select('*')->limit(1)->getWhere($where)->getRow();

		if($member):
			return $member;
		endif;

		return false;
	}
	
}
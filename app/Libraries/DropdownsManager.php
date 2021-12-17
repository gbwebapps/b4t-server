<?php 

namespace App\Libraries;

class DropdownsManager {

	private $db;
	
	public function __construct()
	{
		$this->db = db_connect();
	}

	public function typesDropdown()
	{
		$builder = $this->db->table('circuits_types');

		$builder->select('id, type')->orderBy('type', 'asc');

		return $builder->get()->getResult();
	}

	public function circuitsDropdown($deleted = false)
	{
		$builder = $this->db->table('circuits');

		$builder->select('circuits_id, circuits_name');

		if($deleted):
			$builder->where('circuits_deleted_at = ', null);
		endif;

		$builder->orderBy('circuits_name', 'asc');

		return $builder->get()->getResult();
	}

	public function organizersDropdown($deleted = false)
	{
		$builder = $this->db->table('organizers');

		$builder->select('organizers_id, organizers_name');

		if($deleted):
			$builder->where('organizers_deleted_at = ', null);
		endif;

		$builder->orderBy('organizers_name', 'asc');

		return $builder->get()->getResult();
	}

	public function eventsDropdown($status = false, $deleted = false)
	{
		$builder = $this->db->table('events');

		$builder->select('events_id, events_name');

		if($status):
			$builder->where('events_status = ', 1);
		endif;

		if($deleted):
			$builder->where('events_deleted_at = ', null);
		endif;

		$builder->orderBy('events_name', 'asc');

		return $builder->get()->getResult();
	}

	public function membersDropdown($status = false, $deleted = false)
	{
		$builder = $this->db->table('members');

		$builder->select('members_id, members_firstname, members_lastname');

		if($status):
			$builder->where('members_status = ', 1);
		endif;

		if($deleted):
			$builder->where('members_deleted_at = ', null);
		endif;

		$builder->orderBy('members_lastname', 'asc');

		return $builder->get()->getResult();
	}

}
<?php 

namespace App\Libraries;

class StatisticsManager {

	private $db;
	
	public function __construct()
	{
		$this->db = db_connect();
	}

	public function countAll(String $table): Int
	{
		$builder = $this->db->table($table);

		$items = $builder->countAllResults();

		return $items;
	}

	public function countAllInactivated(String $table): Int
	{
		$builder = $this->db->table($table);

		$builder->where($table . '_status = ', 2);
		$items_inactivated = $builder->countAllResults();

		return $items_inactivated;
	}

}
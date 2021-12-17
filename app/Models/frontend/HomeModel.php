<?php 

namespace App\Models\frontend;

class HomeModel
{
	protected $db;
	protected $builder;

	public function __construct()
	{
		$this->db = db_connect();
	}

	public function getData(String $module): Array
	{
		$this->builder = $this->db->table($module);

		$select = '' . $module . '_id, ' . $module . '_name, ' . $module . '_short_description, ' . $module . '_created_at, 
				   (select meta_tags_slug from meta_tags where meta_tags_entity = "' . $module . '" and meta_tags_entity_id = ' . $module . '_id) as meta_tags_slug, 
				   (select files_name from files where files_entity = "' . $module . '" and files_entity_id = ' . $module . '_id and files_is_cover = "1") as files_name';

		if($module == 'news'):
			$this->builder->where(['news_in_home' => 1, 'news_status' => 1, 'news_deleted_at' => null]);
		elseif($module == 'circuits' || $module == 'organizers'):
			$this->builder->where([$module . '_deleted_at' => null]);
		else:
			$this->builder->where([$module . '_status' => 1, $module . '_deleted_at' => null]);
		endif;

	    return $this->builder->select($select)->limit(3)->orderBy($module . '_id', 'desc')->get()->getResult();
	}

	public function getSector(Int $id): Object
	{
		$builder = $this->db->table('sections');
		return $builder->where(['sections_id' => $id])->limit(1)->get()->getRow();
	}
}
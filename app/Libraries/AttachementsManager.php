<?php declare(strict_types=1);

namespace App\Libraries;

class AttachementsManager {

	private $controller;
	private $db;
	
	public function __construct(String $controller)
	{
		$this->controller = $controller;
		$this->db = db_connect();
	}

	public function showAttachements(Int $id)
	{
		$builder = $this->db->table('files');
		$query = $builder->orderBy('files_is_cover', 'desc')->getWhere(['files_entity_id' => $id, 'files_entity' => $this->controller]);

		if($query->getNumRows() > 0):
			return $query->getResult();
		else:
			return 'nothing';
		endif;

		return false;
	}

	public function deleteAttachement(Int $id): Bool
	{
		$builder = $this->db->table('files');
		$file = $builder->select('files_name')->getWhere(['files_id' => (int)$id])->getRow();

		if($builder->delete(['files_id' => (int)$id])):
			$fileSizes = array('large', 'medium', 'small');

			foreach($fileSizes as $size):
				if(file_exists('./files/' . $this->controller . '/' . $size . '/' . $file->files_name)):
					unlink('./files/' . $this->controller . '/' . $size . '/' . $file->files_name);
				endif;
			endforeach;

			return true;
		endif;

		return false;
	}

	public function setCoverAttachement(Int $id, Int $sectorid): Bool
	{
		$builder = $this->db->table('files');

		$this->db->transBegin();

		$builder->update(['files_is_cover' => '0'], ['files_entity_id' => (int)$sectorid, 'files_entity' => $this->controller]);
		$builder->update(['files_is_cover' => '1'], ['files_id' => (int)$id]);

		if ($this->db->transStatus() === false):
			$this->db->transRollback();
			return false;
		else:
			$this->db->transCommit();
			return true;
		endif;
	}

	public function removeCoverAttachement(Int $id, Int $sectorid): Bool
	{
		$builder = $this->db->table('files');

		if ($builder->update(['files_is_cover' => '0'], ['files_id' => (int)$id, 'files_entity_id' => (int)$sectorid, 'files_entity' => $this->controller])):
			return true;
		else:
			return false;
		endif;
	}

}
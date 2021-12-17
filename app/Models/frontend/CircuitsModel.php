<?php 

namespace App\Models\frontend;

class CircuitsModel extends FrontendModel 
{
	protected $table = 'circuits';
	protected $primaryKey = 'circuits_id';

	protected $selectGetData = 'circuits_id, 
								circuits_name, 
								circuits_short_description, 
								circuits_created_at, 
								(select meta_tags_slug from meta_tags where meta_tags_entity = "circuits" and meta_tags_entity_id = circuits_id) as meta_tags_slug, 
								(select files_name from files where files_entity = "circuits" and files_entity_id = circuits_id and files_is_cover = "1") as files_name';

	protected $whereData = ['circuits_deleted_at' => null];
								
	protected $groupByData = ['circuits_id'];

	protected $controller = 'circuits';

	public $searchFields = [
		'searchFields.circuits_name' => [
	        'rules'  => 'permit_empty|alpha', 
	        'errors' => [
	            'alpha' => 'backend/global.messages.alpha'
	        ]
	    ],
	];
}
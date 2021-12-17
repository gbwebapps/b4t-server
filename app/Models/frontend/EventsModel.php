<?php 

namespace App\Models\frontend;

class EventsModel extends FrontendModel 
{
	protected $table = 'events';
	protected $primaryKey = 'events_id';

	protected $selectGetData = 'events_id, 
								events_name, 
								events_short_description, 
								events_created_at, 
								(select meta_tags_slug from meta_tags where meta_tags_entity = "events" and meta_tags_entity_id = events_id) as meta_tags_slug, 
								(select files_name from files where files_entity = "events" and files_entity_id = events_id and files_is_cover = "1") as files_name';

	protected $whereData = ['events_status' => 1, 'events_deleted_at' => null];							
								
	protected $groupByData = ['events_id'];

	protected $controller = 'events';

	public $searchFields = [
		'searchFields.events_name' => [
	        'rules'  => 'permit_empty|alpha', 
	        'errors' => [
	            'alpha' => 'backend/global.messages.alpha'
	        ]
	    ],
	];

	// public $searchIds = [];
	// public $searchDate = [];
}
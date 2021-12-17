<?php 

namespace App\Models\frontend;

class NewsModel extends FrontendModel 
{
	protected $table = 'news';
	protected $primaryKey = 'news_id';

	protected $selectGetData = 'news_id, 
								news_name, 
								news_short_description, 
								news_long_description, 
								news_created_at, 
								(select meta_tags_slug from meta_tags where meta_tags_entity = "news" and meta_tags_entity_id = news_id) as meta_tags_slug, 
								(select files_name from files where files_entity = "news" and files_entity_id = news_id and files_is_cover = "1") as files_name';

	protected $whereData = ['news_in_home' => 1, 'news_status' => 1, 'news_deleted_at' => null];

	protected $groupByData = ['news_id'];

	protected $controller = 'news';

	public $searchFields = [
		'searchFields.news_name' => [
	        'rules'  => 'permit_empty|alpha', 
	        'errors' => [
	            'alpha' => 'backend/global.messages.alpha'
	        ]
	    ],
	];

	// public $searchIds = [];
	// public $searchDate = [];
}
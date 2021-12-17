<?php 

namespace App\Models\backend;

class NewsModel extends BackendModel 
{
	protected $table = 'news';
	protected $primaryKey = 'news_id';

	protected $allowedColumns = ['news_id', 
								 'news_name', 
								 'organizer', 
								 'news_in_home', 
								 'news_status'];

	protected $allowedFields = ['news_id', 
								'news_name', 
								'news_organizer_id', 
								'news_short_description', 
								'news_long_description', 
								'filenames', 
								'slug', 
								'title',
								'description'];

	protected $selectGetData = 'news_id, 
								(select files_name from files where files_entity_id = news_id and files_entity = "news" and files_is_cover = "1") as avatar, 
								news_name, 
								news_organizer_id, 
								(select organizers_name from organizers where organizers_id = news_organizer_id) as organizer, 
								news_in_home, 
								news_status, 
								news_created_at, 
								news_updated_at, 
								news_deleted_at';

	protected $selectGetID = 'news_id, 
							  news_name, 
							  news_organizer_id, 
							  (select organizers_name from organizers where organizers_id = news_organizer_id) as organizer, 
							  news_short_description, 
							  news_long_description, 
							  news_in_home, 
							  news_status, 
							  news_created_at, 
							  news_updated_at, 
							  news_deleted_at, 
							  meta_tags_slug, 
							  meta_tags_title, 
							  meta_tags_description';

	protected $joinGetID = [
		'meta_tags' => 'meta_tags.meta_tags_entity_id = news.news_id and meta_tags.meta_tags_entity = "news"'
	];

	protected $controller = 'news';

	public $validationRules = [
		// qui metti news_id in seguito per edit
		'news_name' => [
			'label'  => 'backend/news.form.newField',
			'rules'  => 'required|is_unique[news.news_name,news_id,{news_id}]'
		], 
		'news_short_description' => [
			'label'  => 'backend/news.form.shortContentField',
			'rules'  => 'required' // filtro per textarea
		],
		'news_long_description' => [
			'label'  => 'backend/news.form.longContentField',
			'rules'  => 'required' // filtro per textarea
		],
		'news_organizer_id' => [
			'label'  => 'backend/news.form.organizerIdField',
			'rules'  => 'permit_empty|is_natural'
		],
		'slug' => [
			'label'  => 'backend/global.form.slug',
			'rules'  => 'required' // filtro come stringa
		],
		'title' => [
			'label'  => 'backend/global.form.title',
			'rules'  => 'required' // filtro come stringa
		],
		'description' => [
			'label'  => 'backend/global.form.description',
			'rules'  => 'required' // filtro come stringa
		],
        'files' => [
        	'label' => 'Files',
        	'rules' => 'is_image[files]|max_size[files,10240]|ext_in[files,jpg,gif,png]|max_dims[files,4032,3024]'
        ]
    ];

	public $searchFields = [
	    'searchFields.news_id' => [
	        'rules'  => 'permit_empty|integer', 
	        'errors' => [
	            'integer' => 'backend/global.messages.integer'
	        ]
	    ],
	    'searchFields.news_name' => [
	        'rules'  => 'permit_empty|alpha_numeric', 
	        'errors' => [
	            'alpha_numeric' => 'backend/global.messages.alpha_numeric'
	        ]
	    ]
	];

	public $searchIds = [
		'searchIds.news_organizer_id' => [
		    'rules'  => 'permit_empty|is_natural_minus_one', 
		    'errors' => [
		        'is_natural_minus_one' => 'backend/global.messages.integer'
		    ]
		],
		'searchIds.news_in_home' => [
		    'rules'  => 'permit_empty|in_list[2,1]', 
		    'errors' => [
		        'in_list' => 'backend/global.messages.integer'
		    ]
		],
	];

	public $searchDate = [];

	public function add(Array $posts): Array
	{
		$this->db->transBegin();

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			// Estraggo ed elimino i posts di eventuali files
			if(isset($posts['filenames']) && ! empty($posts['filenames'])):
				$filenames = $posts['filenames'];
			endif;
			unset($posts['filenames']);

			$posts['news_in_home'] = (empty($posts['news_organizer_id']) ? '1' : '2');
			$posts['news_status'] = (empty($posts['news_organizer_id']) ? '1' : '2');
			$posts['news_created_at'] = date('Y-m-d H:i:s');

			// Estraggo ed elimino i meta tags
			$meta_tags = [];

			$slug = mb_url_title($posts['slug'], '-', true);

			$meta_tags['meta_tags_entity'] = $this->controller;
			$meta_tags['meta_tags_slug'] = $slug;
			$meta_tags['meta_tags_title'] = $posts['title'];
			$meta_tags['meta_tags_description'] = $posts['description'];
			unset($posts['slug'], $posts['title'], $posts['description']);

			// Inserisco i dati nella tabella principale
			$this->builder->insert($posts);
			$id = $this->db->insertID();

			// Inserisco i dati pertinenti nella tabella meta_tags
			$meta_tags['meta_tags_entity_id'] = $id;
			$builder = $this->db->table('meta_tags');
			$builder->insert($meta_tags);

			// Se esistono files allegati li ciclo e li inserisco
			if(isset($filenames) && ! empty($filenames)):
				$dataFiles = [];

				foreach($filenames as $k => $v):
					
					$dataFiles[$k]['files_is_cover'] = (($k === 0) ? '1' : '0');
					$dataFiles[$k]['files_entity_id'] = $id;
					$dataFiles[$k]['files_entity'] = $this->controller;
					$dataFiles[$k]['files_name'] = $v;

				endforeach;

				$builder = $this->db->table('files');
				$builder->insertBatch($dataFiles);
			endif;

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/news.messages.insertFail')];
        else:
            $this->db->transCommit();
            $news = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/news.messages.insertSuccess', [esc($news->news_name), $id])];
        endif;
	}

	public function edit(Array $posts)
	{
		$this->db->transBegin();

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			// Estraggo ed elimino i posts di eventuali files
			if(isset($posts['filenames']) && ! empty($posts['filenames'])):
				$filenames = $posts['filenames'];
			endif;
			unset($posts['filenames']);

			$id = (int)$posts[$this->primaryKey];

			$posts['news_in_home'] = (empty($posts['news_organizer_id']) ? '1' : '2');
			$posts['news_status'] = (empty($posts['news_organizer_id']) ? '1' : '2');
			$posts['news_organizer_id'] = (empty($posts['news_organizer_id']) ? '-1' : $posts['news_organizer_id']);
			$posts['news_updated_at'] = date('Y-m-d H:i:s');

			// Estraggo ed elimino i meta tags
			$meta_tags = [];

			$slug = mb_url_title($posts['slug'], '-', true);

			$meta_tags['meta_tags_entity'] = $this->controller;
			$meta_tags['meta_tags_slug'] = $slug;
			$meta_tags['meta_tags_title'] = $posts['title'];
			$meta_tags['meta_tags_description'] = $posts['description'];
			unset($posts['slug'], $posts['title'], $posts['description']);

			// Aggiorno i dati nella tabella principale
			$this->builder->update($posts, [$this->primaryKey => $id]);

			// Aggiorno i dati pertinenti nella tabella meta_tags
			$builder = $this->db->table('meta_tags');
			$builder->update($meta_tags, ['meta_tags_entity_id' => $id, 'meta_tags_entity' => $this->controller]);

			if(isset($filenames) && ! empty($filenames)):
				$dataFiles = [];

				// query per sapere se questa entità ha almeno una immagine in is_cover 1
				$builder = $this->db->table('files');
				$query = $builder->getwhere(['files_entity_id' => $id, 'files_is_cover' => '1', 'files_entity' => $this->controller]);

				$flag = ($query->getRow()) ? true : false;

				foreach($filenames as $k => $v):
					if($flag):
						$dataFiles[$k]['files_is_cover'] = '0';
					else:
						$dataFiles[$k]['files_is_cover'] = (($k === 0) ? '1' : '0');
					endif;

					$dataFiles[$k]['files_entity'] = $this->controller;
					$dataFiles[$k]['files_entity_id'] = $id;
					$dataFiles[$k]['files_name'] = $v;
				endforeach;

				$builder = $this->db->table('files');
				$builder->insertBatch($dataFiles);
			endif;

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/news.messages.updateFail'), 'news' => ''];
        else:
            $this->db->transCommit();
            $news = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/news.messages.updateSuccess', [esc($news->news_name), $id]), 'news' => $news];
        endif;
	}
	
	public function delete(Int $id): Array
	{
		$this->db->transBegin();

			$news = $this->getID($id);

			// $builder = $this->db->table('meta_tags');
			// $builder->delete(['meta_tags_entity_id' => $id, 'meta_tags_entity' => $this->controller]);

			// $builder = $this->db->table('files');
			// $builder->select('files_name');
			// $files = $builder->getWhere(['files_entity_id' => $id, 'files_entity' => $this->controller])->getResult();
			// $builder->delete(['files_entity_id' => $id, 'files_entity' => $this->controller]);

			$data = [];

			if($news->news_deleted_at == null):
				$data['news_deleted_at'] = date('Y-m-d H:i:s');
				$messageType = 'delete';
			else:
				$data['news_deleted_at'] = null;
				$messageType = 'restore';
			endif;

			// $this->builder->delete([$this->primaryKey => $id]);
			$this->builder->update($data, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/events.messages.' . $messageType . 'Fail')];
        else:
            // $this->removeImages($files);
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/events.messages.' . $messageType . 'Success', [esc($news->news_name), $id])];
        endif;
	}

	public function inHomeAction(Int $id, Int $in_home): Array
	{
		$this->db->transBegin();

			if($in_home == 1):
				$in_home = 2;
				$messageType = 'Remove';
			else:
				$in_home = 1;
				$messageType = 'Add';
			endif;

			$data = [];
			$data['news_in_home'] = $in_home;
			$data['news_updated_at'] = date('Y-m-d H:i:s');

			$this->builder->where(['news_id' => (int)$id]);
			$this->builder->update($data);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/news.messages.inHome' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            $news = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/news.messages.inHome' . $messageType . 'Success', [esc($news->news_name), $id])];
        endif;
	}

	public function statusAction(Int $id, Int $status): Array
	{
		$this->db->transBegin();

			if($status == 1):
				$status = 2;
				$messageType = 'Inactive';
			else:
				$status = 1;
				$messageType = 'Active';
			endif;

			$data = [];
			$data['news_status'] = $status;
			$data['news_updated_at'] = date('Y-m-d H:i:s');

			$this->builder->where(['news_id' => (int)$id]);
			$this->builder->update($data);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/news.messages.status' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            $news = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/news.messages.status' . $messageType . 'Success', [esc($news->news_name), $id])];
        endif;
	}
}
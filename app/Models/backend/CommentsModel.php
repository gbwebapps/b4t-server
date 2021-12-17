<?php 

namespace App\Models\backend;

class CommentsModel extends BackendModel 
{
	protected $table = 'comments';
	protected $primaryKey = 'comments_id';

	protected $allowedColumns = ['comments_id', 'comments_event_id', 'comments_member_id', 'comments_status'];

	protected $allowedFields = ['comments_id', 'comments_event_id', 'comments_title', 'comments_content'];

	protected $selectGetData = '*, 
								(select members_firstname from members where members_id = comments_member_id) as member, 
								(select events_name from events where events_id = comments_event_id) as event';

	protected $joinGetData = []; // events e members
	protected $groupByData = '';

	protected $selectGetID = '*, 
							  (select members_firstname from members where members_id = comments_member_id) as member, 
							  (select events_name from events where events_id = comments_event_id) as event';
	protected $joinGetID = [];

	protected $controller = 'comments';

	public $validationRules = [
		'comments_event_id' => [
			'label'  => 'backend/comments.form.eventField',
			'rules'  => 'required|is_natural_no_zero'
		],
		'comments_title' => [
			'label'  => 'backend/comments.form.titleField',
			'rules'  => 'required' // mettere regola
		],
		'comments_content' => [
			'label'  => 'backend/comments.form.contentField',
			'rules'  => 'required' // mettere regola
		],
	];

	public $searchFields = [
		'searchFields.comments_id' => [
		    'rules'  => 'permit_empty|integer', 
		    'errors' => [
		        'integer' => 'backend/global.messages.integer'
		    ]
		],
		'searchFields.comments_title' => [
		    'rules'  => 'permit_empty|alpha_numeric', 
		    'errors' => [
		        'alpha_numeric' => 'backend/global.messages.alpha_numeric'
		    ]
		],
		'searchFields.comments_event_id' => [
		    'rules'  => 'permit_empty|is_natural_no_zero', 
		    'errors' => [
		        'is_natural_no_zero' => 'backend/global.messages.is_natural_no_zero'
		    ]
		],
		'searchFields.comments_member_id' => [
		    'rules'  => 'permit_empty|is_natural_no_zero', 
		    'errors' => [
		        'is_natural_no_zero' => 'backend/global.messages.is_natural_no_zero'
		    ]
		],
	];
	public $searchIds = [];
	public $searchDate = [];

	public function add(Array $posts): Array
	{
		$this->db->transBegin();

			$posts = $this->_checkAllowedFields($posts, 'allowedFields'); 

			$posts['comments_created_at'] = date('Y-m-d H:i:s');

			$this->builder->insert($posts);
			$id = $this->db->insertID();

			$comment = $this->getID($id);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/comments.messages.insertFail')];
        else:
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/comments.messages.insertSuccess', [esc($comment->comments_title), esc($comment->comments_id)])];
        endif;
	}

	public function edit(Array $posts): Array
	{
		$this->db->transBegin();

			$posts = $this->_checkAllowedFields($posts, 'allowedFields');

			$id = (int)$posts[$this->primaryKey];

			$posts['comments_updated_at'] = date('Y-m-d H:i:s');

			$this->builder->update($posts, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/comments.messages.updateFail'), 'comment' => null];
        else:
            $this->db->transCommit();
            $comment = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/comments.messages.updateSuccess', [esc($comment->comments_title), $id]), 'comment' => $comment];
        endif;
	}

	public function delete(Int $id): Array
	{
		$this->db->transBegin();

		$comment = $this->getID($id);

		$data = [];

		if($comment->comments_deleted_at == null):
			$data['comments_deleted_at'] = date('Y-m-d H:i:s');
			$messageType = 'delete';
		else:
			$data['comments_deleted_at'] = null;
			$messageType = 'restore';
		endif;

		$this->builder->update($data, [$this->primaryKey => $id]);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/comments.messages.' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            return ['result' => true, 'message' => lang('backend/comments.messages.' . $messageType . 'Success', [esc($comment->comments_title), $id])];
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
			$data['comments_status'] = $status;
			$data['comments_updated_at'] = date('Y-m-d H:i:s');

			$this->builder->where(['comments_id' => (int)$id]);
			$this->builder->update($data);

		if ($this->db->transStatus() === false):
            $this->db->transRollback();
            return ['result' => false, 'message' => lang('backend/comments.messages.status' . $messageType . 'Fail')];
        else:
            $this->db->transCommit();
            $comments = $this->getID($id);
            return ['result' => true, 'message' => lang('backend/comments.messages.status' . $messageType . 'Success', [esc($comments->comments_title), $id])];
        endif;
	}

}
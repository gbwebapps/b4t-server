<?php 

namespace App\Models\backend;

class OrdersModel extends BackendModel 
{
	protected $table = '';
	protected $primaryKey = '';

	protected $allowedColumns = [];
	protected $allowedFields = [];

	protected $selectGetData = '';
	protected $joinGetData = [];
	protected $groupByData = '';

	protected $selectGetID = '';
	protected $joinGetID = [];

	protected $controller = '';

	public function validationRules(){}
	public $searchFields = [];
	public $searchIds = [];
	public $searchDate = [];

	public function add(){}
	public function edit(){}
	public function delete(){}
}
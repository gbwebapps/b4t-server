<?php

namespace App\Controllers\backend;

use App\Libraries\StatisticsManager;

class DashboardController extends BackendController
{
	public function __construct()
	{
		$this->data['controller'] = 'dashboard';
		$this->stats = new StatisticsManager;
	}

	public function index()
	{
		$this->data['action'] = 'index';
		return view('backend/dashboard/index_view', $this->data);
	}

	public function getGeneralStats()
	{
		if($this->request->isAJAX()):

			$controllers = ['circuits', 'organizers', 'events', 'transactions', 'members', 'orders', 'news', 'users'];

			foreach($controllers as $controller):
				$this->data[$controller] = $this->stats->countAll($controller);
				if($controller == 'transactions' || $controller == 'orders' || $controller == 'circuits' || $controller == 'organizers'):
					continue;
				else:
					$this->data[$controller . '_inactivated'] = $this->stats->countAllInactivated($controller);
				endif;
			endforeach;

			$output = view('backend/dashboard/partials/_general_stats_view', $this->data);
			$json = ['output' => $output];

			return $this->response->setJSON($json); die();

		else:
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}

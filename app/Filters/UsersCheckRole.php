<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UsersCheckRole implements FilterInterface
{
    private $authorization;

    public function __construct()
    {
        $this->authorization = service('authorizationUsers');
    }

    public function before(RequestInterface $request, $params = null)
    {
        if($this->authorization->isLoggedIn()->users_role != 1):
            if($request->isAJAX()):
                echo json_encode(['hasRole' => false]); die();
            else:
                return redirect()->to(base_url('admin/dashboard'));
            endif;
        endif;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $params = null)
    {
        // Do something here
    }
    
    //--------------------------------------------------------------------
}
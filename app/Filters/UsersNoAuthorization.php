<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UsersNoAuthorization implements FilterInterface
{
    private $authorization;

    public function __construct()
    {
        $this->authorization = service('authorizationUsers');
    }

    public function before(RequestInterface $request, $params = null)
    {
        if($this->authorization->isLoggedIn()):
            return redirect()->to(base_url('admin/dashboard'));
        endif;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $params = null)
    {
        // Do something here
    }
    
    //--------------------------------------------------------------------
}
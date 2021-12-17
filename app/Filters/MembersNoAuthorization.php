<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class MembersNoAuthorization implements FilterInterface
{
    private $authorizationMembers;

    public function __construct()
    {
        $this->authorizationMembers = service('authorizationMembers');
    }

    public function before(RequestInterface $request, $params = null)
    {
        if($this->authorizationMembers->isLoggedIn()):
            return redirect()->to(base_url('members/account/dashboard'));
        endif;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $params = null)
    {
        // Do something here
    }
    
    //--------------------------------------------------------------------
}
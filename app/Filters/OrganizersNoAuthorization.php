<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class OrganizersNoAuthorization implements FilterInterface
{
    private $authorizationOrganizers;

    public function __construct()
    {
        $this->authorizationOrganizers = service('authorizationOrganizers');
    }

    public function before(RequestInterface $request, $params = null)
    {
        if($this->authorizationOrganizers->isLoggedIn()):
            return redirect()->to(base_url('organizers/account/dashboard'));
        endif;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $params = null)
    {
        // Do something here
    }
    
    //--------------------------------------------------------------------
}
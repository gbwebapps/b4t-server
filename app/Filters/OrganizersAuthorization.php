<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class OrganizersAuthorization implements FilterInterface
{
    private $authorizationOrganizers;

    public function __construct()
    {
        $this->authorizationOrganizers = service('authorizationOrganizers');
    }

    public function before(RequestInterface $request, $params = null)
    {
        if( ! $this->authorizationOrganizers->isLoggedIn()):
            if($request->isAJAX()):
                echo json_encode(['isLoggedIn' => false]); die();
            else:
                return redirect()->to(base_url('organizers/login'));
            endif;
        endif;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $params = null)
    {
        // Do something here
    }
    
    //--------------------------------------------------------------------
}
<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class MembersAuthorization implements FilterInterface
{
    private $authorizationMembers;

    public function __construct()
    {
        $this->authorizationMembers = service('authorizationMembers');
    }

    public function before(RequestInterface $request, $params = null)
    {
        if( ! $this->authorizationMembers->isLoggedIn()):
            if($request->isAJAX()):
                echo json_encode(['isLoggedIn' => false]); die();
            else:
                return redirect()->to(base_url('members/login'));
            endif;
        endif;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $params = null)
    {
        // Do something here
    }
    
    //--------------------------------------------------------------------
}
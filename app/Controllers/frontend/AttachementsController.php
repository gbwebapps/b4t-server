<?php

namespace App\Controllers\frontend;

class AttachementsController extends Controller
{
    public function __construct()
    {
        // loading the model
        // establishing which controller
    }
    
    public function showAttachements() // Funzione che mostra le immagini
    {
        if($this->request->isAJAX()):

            // some code here...

        else:
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        endif;
    }
}

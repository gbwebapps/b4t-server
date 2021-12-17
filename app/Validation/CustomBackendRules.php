<?php

namespace App\Validation;

use App\Libraries\Token;

class CustomBackendRules
{
    private $db;

    /**
     * Is a Natural number or -1 (-1,1,2,3, etc.)
     */
    public function is_natural_minus_one(?string $str = null): bool
    {
        if($str === '-1' || ctype_digit($str)):
            return true;
        endif;

        return false;
    }

    public function checkActivationCode(String $token, String &$error = null): Bool
    {
        $token = new Token($token);
        $hash = $token->getHash();

        $this->db = db_connect();
        $builder = $this->db->table('users');
        $query = $builder->select('users_activation_hash')->limit(1)->getWhere(['users_activation_hash' => $hash]);

        if($query->getRow('users_activation_hash')):
            return true;
        endif;

        $error = lang('backend/auth.messages.errorActivationCode');
        
        return false;
    }

}
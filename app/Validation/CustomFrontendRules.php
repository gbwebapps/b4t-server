<?php

namespace App\Validation;

use App\Libraries\Token;

class CustomFrontendRules
{
    private $db;

    public function checkMemberActivation(String $token, String &$error = null): Bool
    {
        $token = new Token($token);
        $hash = $token->getHash();

        $this->db = db_connect();
        $builder = $this->db->table('members');
        $query = $builder->select('members_activation_hash')->limit(1)->getWhere(['members_activation_hash' => $hash]);

        if($query->getRow('members_activation_hash')):
            return true;
        endif;

        $error = lang('frontend/members.messages.errorActivationCode');
        
        return false;
    }

    public function checkOrganizerActivation(String $token, String &$error = null): Bool
    {
        $token = new Token($token);
        $hash = $token->getHash();

        $this->db = db_connect();
        $builder = $this->db->table('organizers');
        $query = $builder->select('organizers_activation_hash')->limit(1)->getWhere(['organizers_activation_hash' => $hash]);

        if($query->getRow('organizers_activation_hash')):
            return true;
        endif;

        $error = lang('frontend/organizers.messages.errorActivationCode');
        
        return false;
    }

}
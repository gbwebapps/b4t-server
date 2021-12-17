<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */

    public static function home($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('home');
        }
    
        return new \App\Models\backend\HomeModel;
    }

    public static function circuits($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('circuits');
        }
    
        return new \App\Models\backend\CircuitsModel;
    }

    public static function organizers($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('organizers');
        }
    
        return new \App\Models\backend\OrganizersModel;
    }

    public static function events($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('events');
        }
    
        return new \App\Models\backend\EventsModel;
    }

    public static function news($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('news');
        }
    
        return new \App\Models\backend\NewsModel;
    }

    public static function contacts($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('contacts');
        }
    
        return new \App\Models\backend\ContactsModel;
    }

    public static function dropdownManager($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('dropdownManager');
        }
    
        return new \App\Libraries\DropdownsManager;
    }

    public static function authorizationUsers($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('authorizationUsers');
        }
    
        return new \App\Libraries\AuthorizationUsersManager;
    }

    public static function authorizationMembers($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('authorizationMembers');
        }
    
        return new \App\Libraries\AuthorizationMembersManager;
    }

    public static function authorizationOrganizers($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('authorizationOrganizers');
        }
    
        return new \App\Libraries\AuthorizationOrganizersManager;
    }
}

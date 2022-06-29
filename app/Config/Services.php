<?php

namespace Config;

use App\Models\AdminModel;
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

    public static function isLogged(){

        $sess_id = session()->get('auth_id');
        if($sess_id){
            $model = new AdminModel();
            $res = $model->findAll()[0];
            if($sess_id == $res['session_id'] && time() < strtotime($res['session_expire'])){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }

        
    }

}

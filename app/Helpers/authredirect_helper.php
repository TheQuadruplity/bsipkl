<?php

use App\Models\AdminModel;

function authRedirect(){
    $model = new AdminModel();
    $s = session();

    if($s->get('auth')){
        
        $auth = base64_decode($s->get('auth'));
        $adata = explode(':', $auth, 2);
        $data = $model->find()[0];
        
        if($adata[0] == $data['username'] && $adata[1] == $data['password']){
            return true;
        }
    }
    return false;
}

?>
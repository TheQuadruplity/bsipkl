<?php

namespace App\Controllers;

use App\Models\JenisPersekotModel;

class JenisPersekot extends BaseController
{

    public function index(){
        $model = new JenisPersekotModel();
        $data = $model->findAll();
        $this->page('jenis_persekot', ['data' => $data]);
    }
}
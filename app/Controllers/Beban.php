<?php

namespace App\Controllers;

use App\Models\BebanModel;

class Beban extends BaseController
{
    public function index(){
        $model = new BebanModel();
        $data = $model->findAll();
        $this->page('daftar_beban', ['data' => $data]);
    }
}
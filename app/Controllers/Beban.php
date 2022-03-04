<?php

namespace App\Controllers;

use App\Models\BebanModel;

class Beban extends BaseController
{
    public function index(){
        $model = new BebanModel();
        $databeban = $model->findAll();
        $this->page('daftar_beban', ['data' => $databeban]);
    }
}
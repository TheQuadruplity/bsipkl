<?php

namespace App\Controllers;

use App\Models\RekeningModel;

class Rekening extends BaseController
{
    public function index(){
        $model = new RekeningModel();
        $datarek = $model->findAll();
        $this->page('daftar_rekening', ['data' => $datarek]);
    }
}
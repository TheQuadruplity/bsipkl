<?php

namespace App\Controllers;

use App\Models\PersekotModel;

class PosNeraca extends BaseController
{
    public function index(){
        $model = new PersekotModel();
        $data = $model->findAll();
        $this->page('pos_neraca', ['data' => $data]);
    }
}
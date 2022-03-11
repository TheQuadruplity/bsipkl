<?php

namespace App\Controllers;

use App\Models\PersekotModel;

class PosNeraca extends BaseController
{
    public function index(){
        $model = new PersekotModel();
        $data = $model->getPersekot();
        for($i = 0; $i < sizeof($data); $i++){
            $data[$i]['jumlah'] = numfmt_format($this->currencyfmt, $data[$i]['jumlah']);
            $data[$i]['sisa'] = numfmt_format($this->currencyfmt, $data[$i]['sisa']);
        }
        $this->page('pos_neraca', ['data' => $data]);
    }
}
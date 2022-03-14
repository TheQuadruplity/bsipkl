<?php

namespace App\Controllers;

use App\Models\PersekotModel;

class PosNeraca extends BaseController
{
    public function index(){
        if(!authRedirect()) return redirect()->to(base_url('login'));
        $model = new PersekotModel();
        $data = $model->getPersekot();
        for($i = 0; $i < sizeof($data); $i++){
            $data[$i]['success'] = $data[$i]['sisa']<=0?'table-success':'';
            $data[$i]['jumlah'] = numfmt_format($this->currencyfmt, $data[$i]['jumlah']);
            $data[$i]['sisa'] = numfmt_format($this->currencyfmt, $data[$i]['sisa']);
        }
        $this->page('pos_neraca', ['data' => $data]);
    }

    public function printMemo($id){
        if(!authRedirect()) return redirect()->to(base_url('login'));
        $model = new PersekotModel();
        $data = $model->memoPersekot($id);
        $reg = substr($data['id']+10000, 1).'/'.
            substr($data['idjenis']+100, 1).'/'.
            date('m-d', strtotime($data['waktu'])).'/'.
            date('Y', strtotime($data['waktu']));
        echo view('prints/memo_persekot', ['data' => $data, 'reg' => $reg]);
        
    }
}
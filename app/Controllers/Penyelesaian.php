<?php

namespace App\Controllers;

use App\Models\BebanModel;
use App\Models\PenyelesaianModel;
use App\Models\PersekotModel;
use App\Models\RekeningModel;

class Penyelesaian extends BaseController
{
    public function index(){
        $persekotmodel = new PersekotModel();
        $bebanmodel = new BebanModel();
        $persekot = $persekotmodel->builder()->
        select('id, narasi, sisa')->
        where('sisa > 0')->
        get()->getResultArray();
        $beban = $bebanmodel->findAll();
        for($i=0; $i<sizeof($persekot); $i++) $persekot[$i]['sisa'] = numfmt_format($this->currencyfmt, $persekot[$i]['sisa']);
        $this->page('penyelesaian', 
        ['persekot' => $persekot, 'beban' => $beban]);
    }

    public function save(){
        $model = new PenyelesaianModel();

        /*
        $ins = [];
        foreach($this->request->getPost('successdata') as $d){
            $ob = [
                'beban' => $d['beban'], 
                'jumlah' => $d['jumlah'], 
                'persekot' => $d['persekot'], 
                'rekening' => $d['rekening'], 
                'keterangan' => $d['keterangan']
            ];
            array_push($ins, $ob);
        }
        */
        
        //$model->insert($this->request->getPost('data'));
        $model->insertBatch($this->request->getPost('successdata'));

        $data['data'] = $this->request->getPost('successdata');
        $data['waktu'] = date("Y-m-d H:i:s");
        $data['json'] = json_encode($data['data']);
        $this->page('penyelesaian_submit', $data);
    }

    public function print(){
        echo view('prints/penyelesaian', ['data' => $this->request->getPost('data')]);
    }
}
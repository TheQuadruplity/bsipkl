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
        $rekeningmodel = new RekeningModel();
        $persekot = $persekotmodel->builder()->
        select('id, narasi')->
        where('sisa > 0')->
        get()->getResultArray();
        $beban = $bebanmodel->findAll();
        $rekening = $rekeningmodel->findAll();
        $this->page('penyelesaian', 
        ['persekot' => $persekot, 'beban' => $beban, 'rekening' => $rekening]);
    }

    public function save(){
        $model = new PenyelesaianModel();

        $ins = [];
        foreach($this->request->getPost('data') as $d){
            $ob = [
                'beban' => $d['beban'], 
                'jumlah' => $d['jumlah'], 
                'persekot' => $d['persekot'], 
                'rekening' => $d['rekening'], 
                'keterangan' => $d['keterangan']
            ];
            array_push($ins, $ob);
        }
        
        //$model->insert($this->request->getPost('data'));
        $model->insertBatch($this->request->getPost('data'));
    }

    public function submit(){
        $this->page('penyelesaian_submit', ['data' => $this->request->getPost('successdata')]);
    }
}
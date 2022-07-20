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
        select('id, narasi, sisa')->
        where('sisa > 0')->
        get()->getResultArray();
        $beban = $bebanmodel->findAll();
        $rekening = $rekeningmodel->findAll();
        for($i=0; $i<sizeof($persekot); $i++) $persekot[$i]['sisa'] = numfmt_format($this->currencyfmt, $persekot[$i]['sisa']);
        $this->page('penyelesaian', 
        ['persekot' => $persekot, 'beban' => $beban, 'rekening' => $rekening]);
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

        $this->page('penyelesaian_submit', ['data' => $this->request->getPost('successdata')]);
    }

    public function delete($id){
        if($this->request->getMethod() == 'post'){
            $model = new PenyelesaianModel();
        }
    }

    public function print(){
        echo view('prints/penyelesaian', ['data' => $this->request->getPost('data')]);
    }
}
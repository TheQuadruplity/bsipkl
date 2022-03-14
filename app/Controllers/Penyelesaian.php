<?php

namespace App\Controllers;

use App\Models\BebanModel;
use App\Models\PenyelesaianModel;
use App\Models\PersekotModel;
use App\Models\RekeningModel;

class Penyelesaian extends BaseController
{
    public function index(){
        if(!authRedirect()) return redirect()->to(base_url('login'));
        $persekotmodel = new PersekotModel();
        $bebanmodel = new BebanModel();
        $rekeningmodel = new RekeningModel();
        $persekot = $persekotmodel->builder()->
        select('id, narasi')->
        where('sisa < 0')->
        get()->getResultArray();
        $beban = $bebanmodel->findAll();
        $rekening = $rekeningmodel->findAll();
        $this->page('penyelesaian', 
        ['persekot' => $persekot, 'beban' => $beban, 'rekening' => $rekening]);
    }

    public function save(){
        $model = new PenyelesaianModel();
        $data = [
            'beban' => $this->request->getPost('beban'), 
            'jumlah' => $this->request->getPost('jumlah'), 
            'rekening' => $this->request->getPost('rekening'), 
            'persekot' => $this->request->getPost('persekot')
        ];

        $model->insert($data);

        return redirect()->to(base_url().'/posbeban');
    }
}
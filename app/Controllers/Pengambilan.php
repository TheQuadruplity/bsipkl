<?php

namespace App\Controllers;

use App\Models\JenisPersekotModel;
use App\Models\PersekotModel;

class Pengambilan extends BaseController
{
    public function index(){
        $this->atrdr();
        $model = new JenisPersekotModel();
        $data = $model->findAll();
        $this->page('pengambilan', ['jenis_persekot' => $data]);
    }

    public function save(){
        $model = new PersekotModel();
        $data = [
            'narasi' => $this->request->getPost('narasi'), 
            'jenis' => $this->request->getPost('jenis'), 
            'jumlah' => $this->request->getPost('jumlah'), 
            'sisa' => $this->request->getPost('jumlah')
        ];

        $model->insert($data);

        return redirect()->to(base_url().'/posneraca');
    }
}
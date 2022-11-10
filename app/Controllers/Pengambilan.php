<?php

namespace App\Controllers;

use App\Models\JenisPersekotModel;
use App\Models\PersekotModel;

class Pengambilan extends BaseController
{
    public function index(){
        $model = new JenisPersekotModel();
        $data = $model->findAll();
        $this->page('pengambilan', ['jenis_persekot' => $data]);
    }

    public function save(){
        $model = new PersekotModel();
        $data = [
            'nomor' => $this->request->getPost('nomor'), 
            'narasi' => $this->request->getPost('narasi'), 
            'jenis' => $this->request->getPost('jenis'), 
            'jumlah' => $this->request->getPost('jumlah'), 
            'sisa' => $this->request->getPost('jumlah'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        $model->insert($data);
        $jen = new JenisPersekotModel();
        $data['jenis'] = $jen->find($this->request->getPost('jenis'))['nama'];
        $data['jumlah'] = numfmt_format($this->currencyfmt, $data['jumlah']);
        $this->page('pengambilan_submit', ['data' => $data, 'id' => $model->getInsertID()]);
        //return redirect()->to(base_url().'/posneraca');
    }
}
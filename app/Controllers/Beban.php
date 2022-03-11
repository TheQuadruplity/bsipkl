<?php

namespace App\Controllers;

use App\Models\BebanModel;
use App\Models\PenyelesaianModel;

class Beban extends BaseController
{
    public function index(){
        $model = new BebanModel();
        $data = $model->findAll();
        unset($data[0]);
        $this->page('daftar_beban', ['data' => $data]);
    }

    public function save(){
        if($this->request->getMethod() == 'post'){
            $model = new BebanModel();
            $model->save([
                'nama' => $this->request->getPost('nama')
            ]);
        }

        return redirect()->to(base_url().'/beban');
    }

    public function delete($nomor){
        $model = new BebanModel();
        $model->delete($nomor);

        return redirect()->to(base_url().'/beban');
    }

    public function update(){
        if($this->request->getMethod() == 'post'){
            $model = new BebanModel();
            $model->update($this->request->getPost('id'), [
                'nama' => $this->request->getPost('nama')
            ]);
        }

        return redirect()->to(base_url().'/beban');
    }

    public function rekening($id){
        $model = new PenyelesaianModel();
        $data = $model->builder()
        ->select('penyelesaian.waktu, penyelesaian.jumlah, rekening, persekot.narasi AS persekot')
        ->join('persekot', 'penyelesaian.persekot = persekot.id')
        ->where('beban', $id)
        ->get()->getResultArray();
        $sum = 0;
        foreach($data as $i => $d){
            $sum += $data[$i]['jumlah'];
            $data[$i]['jumlah'] = numfmt_format($this->currencyfmt, $data[$i]['jumlah']);
        }
        $sum = numfmt_format($this->currencyfmt, $sum);
        $modelb = new BebanModel();
        $nama = $modelb->find($id);

        $this->page('rekening_beban', ['data' => $data, 'nama' => $nama['nama'], 'jumlah' => $sum]);
    }
}
<?php

namespace App\Controllers;

use App\Models\RekeningModel;

class Rekening extends BaseController
{
    public function index(){
        $model = new RekeningModel();
        $data = $model->findAll();
        $this->page('daftar_rekening', ['data' => $data]);
    }

    public function save(){
        if(true){ //jaga jaga
            $model = new RekeningModel();
            $model->save([
                'nomor' => $this->request->getPost('nomorRekening'),
                'nama' => $this->request->getPost('namaRekening')
            ]);
        }

        return redirect()->to(base_url().'/rekening');
    }

    public function delete($nomor){
        if(true){ //jaga jaga
            $db = \Config\Database::connect();
            $table = $db->table('rekening');
            $table->where('nomor', $nomor);
            $table->delete();
        }

        return redirect()->to(base_url().'/rekening');
    }
}
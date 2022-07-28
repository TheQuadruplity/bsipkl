<?php

namespace App\Controllers;

use App\Models\JenisPersekotModel;
use App\Models\PenyelesaianModel;
use App\Models\PersekotModel;

class JenisPersekot extends BaseController
{

    public function index(){
        $model = new JenisPersekotModel();
        $data = $model->findAll();
        $model = new PersekotModel();
        $count = $model->builder()->select('jenis')->groupBy('jenis')->get()->getResultArray();
        foreach($count as $c) $co[$c['jenis']] = true;
        $this->page('jenis_persekot', ['data' => $data, 'count' => $co]);
    }

    public function save(){
        if($this->request->getMethod() == 'post'){
            $model = new JenisPersekotModel();
            $model->save([
                'nama' => $this->request->getPost('nama')
            ]);
            session()->set('swal',[
                'title'=>'Berhasil',
                'text'=>'Data berhasil ditambahkan',
                'icon'=>'success',
            ]);
        }

        return redirect()->to(base_url().'/jenispersekot');
    }

    public function delete($nomor){
        $model = new JenisPersekotModel();
        $model->delete($nomor);
        session()->set('swal',[
            'title'=>'Berhasil',
            'text'=>'Data berhasil dihapus',
            'icon'=>'success',
        ]);
        return redirect()->to(base_url().'/jenispersekot');
    }

    public function update(){
        if($this->request->getMethod() == 'post'){
            $model = new JenisPersekotModel();
            $model->update($this->request->getPost('id'), [
                'nama' => $this->request->getPost('nama')
            ]);
            session()->set('swal',[
                'title'=>'Berhasil',
                'text'=>'Data berhasil diubah',
                'icon'=>'success',
            ]);
        }

        return redirect()->to(base_url().'/jenispersekot');
    }
}
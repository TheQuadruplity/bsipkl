<?php

namespace App\Controllers;

use App\Models\BebanModel;

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
}
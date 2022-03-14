<?php

namespace App\Controllers;

use App\Models\JenisPersekotModel;

class JenisPersekot extends BaseController
{

    public function index(){
        $this->atrdr();
        $model = new JenisPersekotModel();
        $data = $model->findAll();
        $this->page('jenis_persekot', ['data' => $data]);
    }

    public function save(){
        if($this->request->getMethod() == 'post'){
            $model = new JenisPersekotModel();
            $model->save([
                'nama' => $this->request->getPost('nama')
            ]);
        }

        return redirect()->to(base_url().'/jenispersekot');
    }

    public function delete($nomor){
        $model = new JenisPersekotModel();
        $model->delete($nomor);

        return redirect()->to(base_url().'/jenispersekot');
    }

    public function update(){
        if($this->request->getMethod() == 'post'){
            $model = new JenisPersekotModel();
            $model->update($this->request->getPost('id'), [
                'nama' => $this->request->getPost('nama')
            ]);
        }

        return redirect()->to(base_url().'/jenispersekot');
    }
}
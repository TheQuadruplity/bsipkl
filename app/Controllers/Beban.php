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
                'nama' => $this->request->getPost('nama'),
                'rekening' => $this->request->getPost('rek')
            ]);
            session()->set('swal',[
                'title'=>'Berhasil',
                'text'=>'Data berhasil ditambahkan',
                'icon'=>'success',
            ]);
        }

        return redirect()->to(base_url().'/beban');
    }

    public function delete($nomor){
        $model = new BebanModel();
        $model->delete($nomor);
        
        session()->set('swal',[
            'title'=>'Berhasil',
            'text'=>'Data berhasil dihapus',
            'icon'=>'success',
        ]);

        return redirect()->to(base_url().'/beban');
    }

    public function update(){
        if($this->request->getMethod() == 'post'){
            $model = new BebanModel();
            $model->update($this->request->getPost('id'), [
                'nama' => $this->request->getPost('nama'),
                'rekening' => $this->request->getPost('rek')
            ]);
            session()->set('swal',[
                'title'=>'Berhasil',
                'text'=>'Data berhasil diubah',
                'icon'=>'success',
            ]);
        }

        return redirect()->to(base_url().'/beban');
    }

    public function rekening($id){
        $model = new BebanModel();
        $data = $model->get_rekening_beban($id);
        $sum = 0;
        foreach($data as $i => $d){
            $sum += $data[$i]['jumlah'];
            $data[$i]['jumlah'] = numfmt_format($this->currencyfmt, $data[$i]['jumlah']);
        }
        $sum = numfmt_format($this->currencyfmt, $sum);
        $rek = $model->find($id);

        $this->page('rekening_beban', ['data' => $data, 'rek' => $rek, 'jumlah' => $sum, 'id' => $id]);
    }

    public function printexcel($id){
        $model = new BebanModel();
        $data = $model->get_rekening_beban($id);
        $sum = 0;
        foreach($data as $i => $d){
            $sum += $data[$i]['jumlah'];
            $data[$i]['nomorpersekot'] = 'PL-'.str_pad($data[$i]['nomorpersekot'], 8, '0', STR_PAD_LEFT);
        }
        $rek = $model->find($id);

        $filename = 'Rekening_'.$rek['rekening'].date('_YmdHis').'.xls';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        echo view('prints/rekening_excel', ['data' => $data, 'sum' => $sum]);
    }
}
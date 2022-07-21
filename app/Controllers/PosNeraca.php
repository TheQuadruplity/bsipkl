<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\JenisPersekotModel;
use App\Models\PersekotModel;

class PosNeraca extends BaseController
{
    public function index(){
        $model = new PersekotModel();
        $data = $model->getPersekot();
        for($i = 0; $i < sizeof($data); $i++){
            $data[$i]['start'] = $data[$i]['sisa']<$data[$i]['jumlah']?'':'table-primary';
            $data[$i]['success'] = $data[$i]['sisa']<=0?'table-success':'';
            $data[$i]['jumlah'] = numfmt_format($this->currencyfmt, $data[$i]['jumlah']);
            $data[$i]['nomor'] = 'PL-'.str_pad($data[$i]['id'], 8, '0', STR_PAD_LEFT);
        }
        $this->page('pos_neraca', ['data' => $data]);
    }

    public function printMemo($id){
        $model = new PersekotModel();
        $mans = new AdminModel();
        $mans = $mans->builder()->select('area_manager, pj_aosm')->get()->getRowArray();
        $data = $model->memoPersekot($id);
        $data['jumlah'] = numfmt_format($this->currencyfmt, $data['jumlah']);
        $reg = substr($data['id']+10000, 1).'/'.
            substr($data['idjenis']+100, 1).'/'.
            date('m-d', strtotime($data['waktu'])).'/'.
            date('Y', strtotime($data['waktu']));
        echo view('prints/memo_persekot', ['data' => $data, 'reg' => $reg, 'now' => date('d M Y'), 'man' => $mans]);
    }
    
    public function detail($id)
    {
        $model = new PersekotModel();
        $model2 = new JenisPersekotModel();
        $data = $model->find($id);
        $data['selesai'] = $data['sisa']<=0?true:false;
        $data['dimulai'] = $data['sisa']<$data['jumlah']?true:false;
        $data['nomor'] = 'PL-'.str_pad($data['id'], 8, '0', STR_PAD_LEFT);
        $data['jumlah'] = numfmt_format($this->currencyfmt, $data['jumlah']);
        $data['sisa'] = numfmt_format($this->currencyfmt, $data['sisa']);
        $data['jenis'] = $model2->find($data['jenis'])['nama'];
        $this->page('persekot_detail', $data);
    }

    public function delete(){
        if($this->request->getMethod() == 'post'){
            $id = $this->request->getPost('id');
            $model = new PersekotModel();
            $model->delete($id);
            session()->set('swal',[
                'title'=>'Berhasil',
                'text'=>'Persekot berhasil dibatalkan',
                'icon'=>'success',
            ]);
        }
    }
}
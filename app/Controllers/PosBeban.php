<?php

namespace App\Controllers;

use App\Models\BebanModel;
use App\Models\PenyelesaianModel;

class PosBeban extends BaseController
{
    public function index(){
        $model = new PenyelesaianModel();
        $data = $model->get_penyelesaian();
        $model = new BebanModel();
        $rekening = $model->findAll();
        $kvrekening = [];
        foreach($rekening as $r) $kvrekening[$r['id']] = ['nama' => $r['nama'], 'rekening' => $r['rekening']];
        foreach($data as $i => $d){
            $data[$i]['jumlah'] = numfmt_format($this->currencyfmt, $d['jumlah']);
            $data[$i]['nomorpersekot'] = 'PL-'.str_pad($d['nomorpersekot'], 8, '0', STR_PAD_LEFT);
            $data[$i]['namabeban'] = $kvrekening[$d['beban']]['nama'];
            $data[$i]['rekening'] = $kvrekening[$d['beban']]['rekening'];
        }
        $this->page('pos_beban', ['data'=>$data]);
    }

    public function delete(){
        if($this->request->getMethod() == 'post'){
            $id = $this->request->getPost('id');
            $model = new PenyelesaianModel();
            $model->delete($id);
            session()->set('swal',[
                'title'=>'Berhasil',
                'text'=>'data berhasil dihapus',
                'icon'=>'success',
            ]);
        }
    }

    public function printexcel(){
        $model = new PenyelesaianModel();
        $data = $model->get_penyelesaian();
        $model = new BebanModel();
        $rekening = $model->findAll();
        $kvrekening = [];
        foreach($rekening as $r) $kvrekening[$r['id']] = ['nama' => $r['nama'], 'rekening' => $r['rekening']];
        foreach($data as $i => $d){
            $data[$i]['jumlah'] = numfmt_format($this->currencyfmt, $d['jumlah']);
            $data[$i]['nomorpersekot'] = 'PL-'.str_pad($d['nomorpersekot'], 8, '0', STR_PAD_LEFT);
            $data[$i]['namabeban'] = $kvrekening[$d['beban']]['nama'];
            $data[$i]['rekening'] = $kvrekening[$d['beban']]['rekening'];
        }
        $data = array_reverse($data);

        $filename = 'Beban_'.date('YmdHis').'.xls';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        echo view('prints/beban_excel', ['data' => $data]);
    }
}
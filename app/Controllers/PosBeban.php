<?php

namespace App\Controllers;

use App\Models\PenyelesaianModel;

class PosBeban extends BaseController
{
    public function index(){
        $model = new PenyelesaianModel();
        $data = $model->get_penyelesaian();
        $jumlah = [];
        foreach($data as $d){
            array_push($jumlah, numfmt_format($this->currencyfmt, $d['jumlah']));
        }
        $this->page('pos_beban', ['data'=>$data, 'jumlah'=>$jumlah]);
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
        $data = array_reverse($data, false);
        for($i = 0; $i < sizeof($data); $i++){
            $data[$i]['nomorpersekot'] = 'PL-'.str_pad($data[$i]['nomorpersekot'], 8, '0', STR_PAD_LEFT);
        }
        $filename = 'Beban_'.date('YmdHis').'.xls';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        echo view('prints/beban_excel', ['data' => $data]);
    }
}
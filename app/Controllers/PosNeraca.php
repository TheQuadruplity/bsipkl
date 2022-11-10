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
        }
        $this->page('pos_neraca', ['data' => $data]);
    }

    public function printMemo($id){
        $model = new PersekotModel();
        $mans = new AdminModel();
        $mans = $mans->builder()->select('area_manager, pj_aosm')->get()->getRowArray();
        $data = $model->memoPersekot($id);
        $data['terbilang'] = $this->terbilang($data['jumlah']);
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

    public function printexcel(){
        $model = new PersekotModel();
        $data = $model->getPersekot();
        $filename = 'Persekot_'.date('YmdHis').'.xls';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        echo view('prints/persekot_excel', ['data' => $data]);
    }

    private function terbilang($n){
        if($n == 0) return 'nol';
        $num = ['nol', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
        $ten = ['sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'];
        $level = ['', 'ribu ', 'juta ', 'milyar '];

        $sep = [];
        while($n != 0){
            array_push($sep, $n%1000);
            $n = floor($n / 1000);
        }
        $t = '';

        for($l = sizeof($sep)-1; $l >= 0; $l--){
            if($sep[$l] == 0) continue;
            if($l == 1 && $sep[$l] == 1) {$t .= 'seribu '; continue;}
            $t2 = '';
            $ar = str_split($sep[$l]);
            $ar = array_reverse($ar);
            if(isset($ar[2])){
                if($ar[2] == 1)$t2 .= 'seratus ';
                else $t2 .= $num[$ar[2]].' ratus ';
            }
            $belas = false;
            if(isset($ar[1])){
                if($ar[1] == 1) {$t2 .= $ten[$ar[0]].' '; $belas = true;}
                else if($ar[1] != 0) $t2 .= $num[$ar[1]].' puluh ';
            }
            if($ar[0] != 0 && !$belas) $t2 .= $num[$ar[0]].' ';
            
            $t .= $t2.$level[$l];
        }
        $t.='rupiah';

        return $t;
    }
}
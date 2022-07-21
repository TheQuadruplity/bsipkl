<?php

namespace App\Controllers;

use App\Models\PenyelesaianModel;

class PosBeban extends BaseController
{
    public function index(){
        $model = new PenyelesaianModel();
        $data = $model->builder()
        ->join('beban', 'penyelesaian.beban=beban.id')
        ->join('persekot', 'penyelesaian.persekot=persekot.id')
        ->select('penyelesaian.waktu, penyelesaian.jumlah, beban, penyelesaian.rekening, beban.nama as beban, persekot.narasi as persekot, penyelesaian.keterangan, penyelesaian.id')
        ->where('YEAR(penyelesaian.waktu) =', $this->yearnow)
        ->orderBy('penyelesaian.waktu', 'DESC')
        ->get()->getResultArray();
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
            return redirect()->to(base_url('posbeban'));
        }
    }
}
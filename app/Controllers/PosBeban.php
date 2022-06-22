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
        ->select('penyelesaian.waktu, penyelesaian.jumlah, beban, penyelesaian.rekening, beban.nama as beban, persekot.narasi as persekot, penyelesaian.keterangan')
        ->orderBy('penyelesaian.waktu', 'DESC')
        ->get()->getResultArray();
        $jumlah = [];
        foreach($data as $d){
            array_push($jumlah, numfmt_format($this->currencyfmt, $d['jumlah']));
        }
        $this->page('pos_beban', ['data'=>$data, 'jumlah'=>$jumlah]);
    }
}
<?php

namespace App\Controllers;

use App\Models\PenyelesaianModel;

class PosBeban extends BaseController
{
    public function index(){
        if(!authRedirect()) return redirect()->to(base_url('login'));
        $db = \Config\Database::connect();
        $builder = $db->table('penyelesaian');
        $builder = $builder->join('beban', 'penyelesaian.beban=beban.id');
        $builder = $builder->join('persekot', 'penyelesaian.persekot=persekot.id');
        $builder = $builder->select('penyelesaian.waktu, penyelesaian.jumlah, beban, rekening, beban.nama as beban, persekot.narasi as persekot');
        $builder = $builder->orderBy('penyelesaian.waktu', 'DESC');
        $query = $builder->get();
        $data = $query->getResultArray();
        $jumlah = [];
        foreach($data as $d){
            array_push($jumlah, numfmt_format($this->currencyfmt, $d['jumlah']));
        }
        $this->page('pos_beban', ['data'=>$data, 'jumlah'=>$jumlah]);
    }
}
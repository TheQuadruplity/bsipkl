<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyelesaianModel extends Model{
    protected $table = 'penyelesaian';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['waktu', 'jumlah', 'beban', 'jumlah', 'rekening', 'persekot', 'keterangan'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = '';

    public function get_penyelesaian(){
        $data = $this->builder()
        ->join('beban', 'penyelesaian.beban=beban.id')
        ->join('persekot', 'penyelesaian.persekot=persekot.id')
        ->select('penyelesaian.waktu, penyelesaian.jumlah, beban, penyelesaian.rekening, beban.nama as beban, persekot.narasi as persekot, penyelesaian.keterangan, penyelesaian.id, penyelesaian.persekot as nomorpersekot')
        ->where('YEAR(penyelesaian.waktu) =', session()->get('ann'))
        ->orderBy('penyelesaian.waktu', 'DESC')
        ->get()->getResultArray();

        return $data;
    }
}
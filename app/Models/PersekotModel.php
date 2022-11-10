<?php

namespace App\Models;

use CodeIgniter\Model;

class PersekotModel extends Model{
    protected $table = 'persekot';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['waktu', 'narasi', 'jumlah', 'jenis', 'sisa', 'keterangan', 'nomor'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = '';

    public function getPersekot(){
        $data = $this->builder()
        ->select('persekot.id AS id, waktu, narasi, jumlah, jenis_persekot.nama as jenis, sisa, keterangan, nomor')
        ->join('jenis_persekot', 'persekot.jenis = jenis_persekot.id')
        ->where('YEAR(waktu) =', session()->get('ann'))
        ->orderBy('waktu', 'DESC')
        ->get()->getResultArray();
        return $data;
    }

    public function memoPersekot($id){
        $data = $this->builder()
        ->select('persekot.id as id, jenis_persekot.id as idjenis, jenis_persekot.nama as namajenis,
        narasi, waktu, jumlah, sisa, keterangan, nomor')
        ->join('jenis_persekot', 'persekot.jenis = jenis_persekot.id')
        ->where('persekot.id', $id)
        ->get()->getRowArray();
        return $data;
    }
}
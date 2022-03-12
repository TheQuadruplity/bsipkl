<?php

namespace App\Models;

use CodeIgniter\Model;

class PersekotModel extends Model{
    protected $table = 'persekot';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['waktu', 'narasi', 'jumlah', 'jenis', 'sisa'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = '';

    public function getPersekot(){
        $data = $this->builder()
        ->select('persekot.id AS id, waktu, narasi, jumlah, jenis_persekot.nama as jenis, sisa')
        ->join('jenis_persekot', 'persekot.jenis = jenis_persekot.id')
        ->get()->getResultArray();
        return $data;
    }

    public function memoPersekot($id){
        $data = $this->builder()
        ->select('persekot.id as id, jenis_persekot.id as idjenis, jenis_persekot.nama as namajenis,
        narasi, waktu, jumlah, sisa')
        ->join('jenis_persekot', 'persekot.jenis = jenis_persekot.id')
        ->where('persekot.id', $id)
        ->get()->getRowArray();
        return $data;
    }
}
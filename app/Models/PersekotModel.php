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
        ->select('waktu, narasi, jumlah, jenis_persekot.nama as jenis, sisa')
        ->join('jenis_persekot', 'persekot.jenis = jenis_persekot.id')
        ->get()->getResultArray();
;
        return $data;
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class BebanModel extends Model{
    protected $table = 'beban';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama', 'rekening'];
    protected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = '';
    protected $updatedField = '';

    public function get_rekening_beban($id)
    {
        $model = new PenyelesaianModel();
        $data = $model->builder()
        ->select('penyelesaian.waktu, penyelesaian.jumlah, rekening, persekot.narasi AS persekot, persekot.id AS nomorpersekot, persekot.keterangan')
        ->join('persekot', 'penyelesaian.persekot = persekot.id')
        ->where('beban', $id)
        ->where('YEAR(penyelesaian.waktu) =', session()->get('ann'))
        ->get()->getResultArray();
        return $data;
    }
}
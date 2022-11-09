<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model{
    protected $table = '_riwayat';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['tipe', 'idkey', 'keterangan', 'jumlah'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = '';
}
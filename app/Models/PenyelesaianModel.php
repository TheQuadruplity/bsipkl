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
}
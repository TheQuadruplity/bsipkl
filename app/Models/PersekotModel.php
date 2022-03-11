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
}
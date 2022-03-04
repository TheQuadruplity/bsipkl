<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPersekotModel extends Model{
    protected $table = 'jenis_persekot';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama'];
    protected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = '';
    protected $updatedField = '';
}
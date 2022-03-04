<?php

namespace App\Models;

use CodeIgniter\Model;

class RekeningModel extends Model{
    protected $table = 'rekening';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nomor', 'nama'];
    protected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = '';
    protected $updatedField = '';
}
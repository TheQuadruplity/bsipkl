<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalModel extends Model{
    protected $table = 'jurnal';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [];
    protected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = '';
    protected $updatedField = '';
}
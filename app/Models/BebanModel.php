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
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model{
    protected $table = 'admin';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['username', 'password'];
    protected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = '';
    protected $updatedField = '';
}
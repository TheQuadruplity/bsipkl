<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model{
    protected $table = 'admin';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['username', 'password', 'session_id', 'session_expire', 'pj_aosm'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = '';
}
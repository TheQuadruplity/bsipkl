<?php

namespace App\Models;

use CodeIgniter\Model;
use DateInterval;
use DateTime;
use NumberFormatter;

class JurnalModel extends Model{
    protected $table = 'jurnal';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [];
    protected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = '';
    protected $updatedField = '';

    public function getJurnal($bulan){
        $currencyfmt = numfmt_create('ID_id', NumberFormatter::CURRENCY);
        $tgl = explode('-', $bulan);
        $db = \Config\Database::connect();
        $month = $tgl[1];
        $year = $tgl[0];
        

        $q = $db->query("CALL get_jurnal($month, $year)");
        $res = $q->getResultArray();
        $dt = new DateTime();
        $dt->setDate(date('Y'), date('m'), 1);
        $dt->setTime(0, 0);
        $nt = clone $dt;
        $nt = $nt->add(new DateInterval('P1M'));
        $df = date_diff($dt, $nt, true)->days;

        $qdata = [];
        foreach($res as $d){
            $qdata[$d['hari']] = numfmt_format($currencyfmt, $d['saldo']);
        }

        $daydata = [0 => $qdata[0]];
        for($i = 1; $i <= $df; $i++){
            if(isset($qdata[$i])){
                $daydata[$i] = $qdata[$i];
            }
            else{
                $daydata[$i] = $daydata[$i-1];
            }
        }
        unset($daydata[0]);
        
        $data = ['data' => $daydata, 'month' => $month, 'year' => $year];
        return $data;
    }
}
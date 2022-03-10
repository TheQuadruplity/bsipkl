<?php

namespace App\Controllers;

use App\Models\JurnalModel;
use DateInterval;
use DateTime;

class PosNeraca extends BaseController
{
    public function index(){
        $db = \Config\Database::connect();
        $month = date('m');
        $year = date('Y');
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
            $qdata[$d['hari']] = numfmt_format($this->currencyfmt, $d['saldo']);
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
        
        //$dt = $dt->add(new DateInterval('P1D'));
        $this->page('pos_neraca', 
        ['data' => $daydata, 'month' => $month, 'year' => $year]);
    }

    public function harian($tanggal){
        $tgl = explode('-', $tanggal);
        $db = \Config\Database::connect();
        $model = new JurnalModel();
        $sql = "(SELECT * FROM jurnal z
        WHERE DATE(z.waktu) < STR_TO_DATE('$tanggal', '%Y-%m-%d') ORDER BY z.waktu DESC LIMIT 1)
        UNION
        (SELECT * FROM jurnal j WHERE STR_TO_DATE('$tanggal', '%Y-%m-%d') = DATE(j.waktu) ORDER BY j.waktu ASC)
        ";
        $q = $db->query($sql);
        $res = $q->getResultArray();
        $data = [['waktu'=>'00:00:00', 
        'nama'=>'saldo sebelumnya', 
        'debit' => '-',
        'kredit' => '-',
        'saldo' => numfmt_format($this->currencyfmt, $res[0]['saldo'])]];
        for($i = 1; $i < sizeof($res); $i++){
            $dt = new DateTime($res[$i]['waktu']);
            $time = $dt->format('h:i:s');
            array_push($data,  ['waktu'=> $time, 
            'nama'=> $res[$i]['nama'], 
            'debit' => $res[$i]['debit']?numfmt_format($this->currencyfmt, $res[$i]['debit']):'-',
            'kredit' => $res[$i]['kredit']?numfmt_format($this->currencyfmt, $res[$i]['kredit']):'-',
            'saldo' => numfmt_format($this->currencyfmt, $res[$i]['saldo'])]);
        }
        $this->page('persekot_harian', 
        ['data' => $data, 'year' => $tgl[0], 'month' => $tgl[1], 'day' => $tgl[2]]);

    }
}
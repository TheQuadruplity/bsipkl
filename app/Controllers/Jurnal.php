<?php

namespace App\Controllers;

use App\Models\JurnalModel;
use DateInterval;
use DateTime;

class Jurnal extends BaseController
{
    public function index(){
        if(!authRedirect()) return redirect()->to(base_url('login'));
        $model = new JurnalModel();
        $this->page('jurnal', $model->getJurnal(date('Y-m')));

    }

    public function harian($tanggal){
        if(!authRedirect()) return redirect()->to(base_url('login'));
        $tgl = explode('-', $tanggal);
        $db = \Config\Database::connect();
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

    public function jurnal($bulan){
        if($this->request->isAJAX()){
            $model = new JurnalModel();
            $data = $model->getJurnal(date($bulan));
            echo view('minis/jurnal', $data);
        }
    }
}
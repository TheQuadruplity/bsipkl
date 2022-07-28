<?php

namespace App\Controllers;

use App\Models\JurnalModel;
use CodeIgniter\Model;
use DateInterval;
use DateTime;

class Jurnal extends BaseController
{
    public function index(){
        $model = new JurnalModel();
        $thisyear = $this->yearnow==date('Y');
        $datemin = $this->yearnow.'-01-01';
        $datemax = $thisyear?date('Y-m-d'):$this->yearnow.'-12-31';

        $data = $thisyear?$model->getJurnal(date('Y-m-d'),date('Y-m-d')):$model->getJurnal($datemax,$datemax);

        $this->page('jurnal', ['datemin' => $datemin, 'datemax' => $datemax, 'now' => $thisyear?date('Y-m-d'):$datemax, 'data'=>$data]);
    }

/*     public function harian($tanggal){
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

    } */

    public function jurnal($awal, $akhir){
        if($this->request->isAJAX()){
            $model = new JurnalModel();
            $data['data'] = $model->getJurnal($awal, $akhir);
            echo view('minis/jurnal', $data);
        }
        else{
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function delete(){
        if($this->request->getMethod() == 'post'){
            $id = $this->request->getPost('id');
            if(is_numeric($id)){
                $model = new JurnalModel();
                $model->db->query("CALL delete_jurnal(?)", [$id]);
                session()->set('swal',[
                    'title'=>'Berhasil',
                    'text'=>'data berhasil dihapus',
                    'icon'=>'success',
                ]);
            }
        }
    }

    public function print_j($awal, $akhir){
        $model = new JurnalModel();
        $data['data'] = $model->getJurnal($awal, $akhir);
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;
        echo view('prints/jurnal', $data);
    }
}
<?php

namespace App\Controllers;

use App\Models\AdminModel;
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
        $mans = new AdminModel();
        $data['data'] = $model->getJurnal($awal, $akhir);
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;
        $data['man'] = $mans->builder()->select('area_manager, pj_aosm')->get()->getRowArray();
        echo view('prints/jurnal', $data);
    }
}
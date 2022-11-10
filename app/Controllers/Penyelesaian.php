<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\BebanModel;
use App\Models\JenisPersekotModel;
use App\Models\PenyelesaianModel;
use App\Models\PersekotModel;
use App\Models\RekeningModel;
use Exception;

class Penyelesaian extends BaseController
{
    public function index(){
        $persekotmodel = new PersekotModel();
        $bebanmodel = new BebanModel();
        $persekot = $persekotmodel->builder()->
        select('id, narasi, sisa')->
        where('sisa > 0')->
        get()->getResultArray();
        $beban = $bebanmodel->findAll();
        $this->page('penyelesaian', 
        ['persekot' => $persekot, 'beban' => $beban]);
    }

    public function save(){
        $model = new PenyelesaianModel();
        $model2 = new BebanModel();
        $model3 = new PersekotModel();
        $model4 = new JenisPersekotModel();

        $ins = [];
        $savedata = [];
        foreach(json_decode($this->request->getPost('successdata'), true) as $d){
            $beban = $model2->find($d['beban']);
            $persekot = $model3->find($d['persekot']);
            $jenis = $model4->find($persekot['jenis']);
            $ob = [
                'rekening_beban' => $beban['rekening'], 
                'nama_beban' => $beban['nama'], 
                'jumlah_beban' => numfmt_format($this->currencyfmt,$d['jumlah']), 
                'rekening_persekot' => $jenis['rekening'], 
                'narasi_persekot' => $persekot['narasi'], 
                'jumlah_persekot' => numfmt_format($this->currencyfmt,$d['jumlah']),
                'keterangan' => $d['keterangan'],
            ];
            array_push($ins, $ob);

            $d['rekening'] = $beban['rekening'];
            array_push($savedata, $d);
        }
        
        //$model->insert($this->request->getPost('data'));
        $model->insertBatch($savedata);

        $data['data'] = $ins;
        $data['waktu'] = date("Y-m-d H:i:s");
        $data['json'] = json_encode($data['data']);
        $this->page('penyelesaian_submit', $data);
    }

    public function print(){
        $mans = new AdminModel();
        $mans = $mans->builder()->select('area_manager, pj_aosm')->get()->getRowArray();
        $senddata = ['data' => json_decode($this->request->getPost('data'), true),
        'man' => $mans,
        'waktu' => $this->request->getPost('waktu')];
        echo view('prints/penyelesaian', $senddata);
    }

    public function printattime($datetime){
        $model = new PenyelesaianModel();
        $res = $model->builder()->select(
            "penyelesaian.waktu as waktu, penyelesaian.jumlah as jumlah, beban.nama as nama_beban, beban.rekening as rekening_beban,
            persekot.narasi as narasi_persekot, jenis_persekot.rekening as rekening_persekot, penyelesaian.keterangan as keterangan"
        )
        ->join("beban", "beban.id = penyelesaian.beban")
        ->join("persekot", "persekot.id = penyelesaian.persekot")
        ->join("jenis_persekot", "jenis_persekot.id = persekot.jenis")
        ->where("penyelesaian.waktu = '$datetime'")->get()->getResultArray();
        foreach($res as $i => $d){
            $res[$i]['jumlah_beban'] = numfmt_format($this->currencyfmt,$d['jumlah']);
            $res[$i]['jumlah_persekot'] = numfmt_format($this->currencyfmt,$d['jumlah']);
        }

        $mans = new AdminModel();
        $mans = $mans->builder()->select('area_manager, pj_aosm')->get()->getRowArray();
        $senddata = ['data' => $res,
        'man' => $mans,
        'waktu' => $datetime];
        echo view('prints/penyelesaian', $senddata);
    }
}
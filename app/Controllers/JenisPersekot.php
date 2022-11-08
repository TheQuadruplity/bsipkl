<?php

namespace App\Controllers;

use App\Models\BebanModel;
use App\Models\JenisPersekotModel;
use App\Models\PenyelesaianModel;
use App\Models\PersekotModel;

class JenisPersekot extends BaseController
{

    public function index(){
        $model = new JenisPersekotModel();
        $data = $model->findAll();
        $model = new PersekotModel();
        $count = $model->builder()->select('jenis')->groupBy('jenis')->get()->getResultArray();
        $co = [];
        foreach($count as $c) $co[$c['jenis']] = true;
        $this->page('jenis_persekot', ['data' => $data, 'count' => $co]);
    }

    public function save(){
        if($this->request->getMethod() == 'post'){
            $model = new JenisPersekotModel();
            $model->save([
                'nama' => $this->request->getPost('nama'),
                'rekening' => $this->request->getPost('rekening')
            ]);
            session()->set('swal',[
                'title'=>'Berhasil',
                'text'=>'Data berhasil ditambahkan',
                'icon'=>'success',
            ]);
        }

        return redirect()->to(base_url().'/jenispersekot');
    }

    public function delete($nomor){
        $model = new JenisPersekotModel();
        $model->delete($nomor);
        session()->set('swal',[
            'title'=>'Berhasil',
            'text'=>'Data berhasil dihapus',
            'icon'=>'success',
        ]);
        return redirect()->to(base_url().'/jenispersekot');
    }

    public function update(){
        if($this->request->getMethod() == 'post'){
            $model = new JenisPersekotModel();
            $model->update($this->request->getPost('id'), [
                'nama' => $this->request->getPost('nama'),
                'rekening' => $this->request->getPost('rekening')
            ]);
            session()->set('swal',[
                'title'=>'Berhasil',
                'text'=>'Data berhasil diubah',
                'icon'=>'success',
            ]);
        }

        return redirect()->to(base_url().'/jenispersekot');
    }


    private function rekening($id){
        $jenismodel = new JenisPersekotModel();
        $pmodel = new PersekotModel();
        $bmodel = new PenyelesaianModel();

        $data = [];
        $res1 = $pmodel->builder()->select("id, narasi, waktu, jumlah, keterangan")
        ->where('jenis', $id)
        ->orderBy('waktu', 'ASC')->get()->getResultArray();
        $saldo = 0;
        foreach($res1 as $r){
            $saldo -= $r['jumlah'];
            $res2 = $bmodel->builder()->select('waktu, b.nama as nama, jumlah, keterangan')
            ->join('beban b', 'b.id = penyelesaian.beban')
            ->where('persekot', $r['id'])
            ->orderBy('waktu', 'ASC')->get()->getResultArray();

            $rdat = [
                'waktu' => $r['waktu'],
                'no' => 'PL-'.str_pad($r['id'], 8, '0', STR_PAD_LEFT),
                'nama' => $r['narasi'],
                'd' => numfmt_format($this->currencyfmt, $r['jumlah']),
                'k' => '-',
                's' => numfmt_format($this->currencyfmt, $saldo),
                'ket' => $r['keterangan']
            ];
            array_push($data, $rdat);

            foreach($res2 as $r2){
                $saldo += $r2['jumlah'];
                $rdat = [
                    'waktu' => $r2['waktu'],
                    'no' => 'PL-'.str_pad($r['id'], 8, '0', STR_PAD_LEFT),
                    'nama' => $r2['nama'],
                    'd' => '-',
                    'k' => numfmt_format($this->currencyfmt, $r2['jumlah']),
                    's' => numfmt_format($this->currencyfmt, $saldo),
                    'ket' => $r2['keterangan']
                ];
                array_push($data, $rdat);
            }
        }

        $np = $jenismodel->find($id);

        return ['data' => $data, 'nama' => $np['nama'], 'id' => $id];
    }

    public function mutasi($id){
        $this->page('mutasi_persekot', $this->rekening($id));
    }

    public function printexcel($id){
        $jenis = new JenisPersekotModel();
        $nama = $jenis->find($id)['nama'];
        $filename = 'Jenis_'.$nama.'_'.date('_YmdHis').'.xls';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        echo view('prints/jenis_persekot_excel', $this->rekening($id));
    }

}
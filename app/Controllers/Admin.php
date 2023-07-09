<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\RiwayatModel;

class Admin extends BaseController
{
    public function index()
    {
        $s = session();
        $model = new AdminModel();
        $data = $model->find()[0];
        $year = date('Y');
        $loweryear = 2001;
        $ys = [];
        while($year >= $loweryear) array_push($ys, $year--);
        
        $this->page('admin', ['data' => $data, 
                              'msg' => $s->getFlashdata('msg'), 
                              'years' => $ys, 
                              'year' => session()->get('ann'), 
                              'date' => date('Y-m-d')]);
    }

    public function validatePass($pass = ""){
        if($this->request->isAJAX()){
            $model = new AdminModel();
            $data = $model->builder()->where("password", sha1($pass))->countAllResults();
            if($data) $this->response->setStatusCode(202);
            else $this->response->setStatusCode(403);
        }
        else{
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function update()
    {
        if($this->request->getMethod() == 'post'){
            $model = new AdminModel();
            $s = session();
            if($this->request->getPost('username')){
                $model->update(null,['username' => $this->request->getPost('username')]);
                $msg = 'Username berhasil diubah!';
            }
            else if($this->request->getPost('password')){
                $model->update(null,['password' => sha1($this->request->getPost('password'))]);
                $msg = 'Password berhasil diubah!';
            }
            else if($this->request->getPost('manager')){
                
                $manager = explode("\t", $this->request->getPost('manager'));
                $model->update(null,['pj_aosm' => $manager[1], 'area_manager' => $manager[0]]);
                $msg = 'Manager berhasil diubah!';
            }
            session()->set('swal',[
                'title'=>'Berhasil',
                'text'=>$msg,
                'icon'=>'success',
            ]);
        }
        return redirect()->to(base_url('admin'));
    }
    
    public static function Annual($year)
    {
        session()->set('ann', $year);
    }

    public function history_delete(){
        if($this->request->getMethod() == 'post'){
            $model = new RiwayatModel();
            $model->builder()->emptyTable();
            $model->insert(['tipe' => 0, 'keterangan' => 'terakhir hapus']);
            session()->set('swal',[
                'title'=>'Berhasil',
                'text'=>'Riwayat Berhasil Dihapus!',
                'icon'=>'success',
            ]);
        }
    }

    public function history($start, $end){
        $model = new RiwayatModel();
        $end = date('Y-m-d', strtotime($end.' +1 day'));
        $res = $model->builder()
        ->select('*')
        ->where("waktu >= '$start' and waktu <= '$end'")
        ->orderBy('waktu', 'ASC')->get()->getResultArray();

        $data = $res;

        $filename = 'Riwayat_'.date('YmdHis').'.xls';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        echo view('prints/riwayat', ['data' => $data]);
    }
}

<?php

namespace App\Controllers;

use App\Models\AdminModel;

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
        $this->page('admin', ['data' => $data, 'msg' => $s->getFlashdata('msg'), 'years' => $ys, 'year' => session()->get('ann')]);
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
                $s->setFlashdata('msg', 'Username berhasil diubah!');
            }
            else if($this->request->getPost('password')){
                $model->update(null,['password' => md5($this->request->getPost('password'))]);
                $s->setFlashdata('msg', 'Password berhasil diubah!');
            }
            else if($this->request->getPost('manager')){
                
                $manager = explode("\t", $this->request->getPost('manager'));
                $model->update(null,['pj_aosm' => $manager[1], 'area_manager' => $manager[0]]);
                $s->setFlashdata('msg', 'Manager berhasil diubah!');
            }
        }

        return redirect()->to(base_url('admin'));
    }
    
    public static function Annual($year)
    {
        session()->set('ann', $year);
    }
}

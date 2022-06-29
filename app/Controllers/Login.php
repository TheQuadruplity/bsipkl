<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function __construct(){
        helper('authredirect');
    }

    public function index()
    {
        if($this->request->getMethod() == 'post'){
            $model = new AdminModel();
            $res = $model->find()[0];
            if($res['username'] == $_POST['username'] && $res['password'] == sha1($_POST['password'])){
                $nid = uniqid();
                session()->set('auth_id', $nid);
                session()->set('ann', date('Y'));
                $model->update(null, ['session_id' => $nid, 'session_expire' => date("Y-m-d H:i:s", strtotime("+1800 second"))]);
                
                return redirect()->to(base_url());
            }
            else{
                $data['msg'] = 'Username atau password salah!';
                echo view('pages/login', $data);
            }
        }
        else{
            $data = ['msg' => ''];
            echo view('pages/login', $data);
        }
    }
    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}

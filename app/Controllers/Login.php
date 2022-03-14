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
            if($res['username'] == $_POST['username'] && $res['password'] == md5($_POST['password'])){
                $ses = base64_encode($_POST['username'].':'.md5($_POST['password']));
                session()->setTempdata('auth', $ses);
                
                return redirect()->to(base_url());
            }
            else{
                $data['msg'] = 'Username atau password salah!';
                echo view('pages/login', $data);
            }
        }
        else{
            if(!authRedirect()){
                if(session()->getFlashdata('msg')){
                    $data['msg'] = session()->getFlashdata('msg');
                }
                else $data['msg'] = '';
                echo view('pages/login', $data);
            }
            else{
                return redirect()->to(base_url());
            }
        }
    }
    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}

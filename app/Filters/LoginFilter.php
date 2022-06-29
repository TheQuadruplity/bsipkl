<?php

namespace App\Filters;

use App\Models\AdminModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface
{

    private function extendSession($time = 1800){
        $model = new AdminModel();
        $model->update(null, ['session_expire' => date("Y-m-d H:i:s", strtotime("+$time second"))]);
    }

    public function before(RequestInterface $request, $arguments = null)
    {

        $islog = service('isLogged');
        if(str_starts_with($request->getServer('REQUEST_URI'), '/login')){
            if(!str_starts_with($request->getServer('REQUEST_URI'), '/login/logout')){
                if($islog){
                    $this->extendSession();
                    return redirect()->to(base_url());
                }
            }
        }
        else{
            if(!$islog){
                session()->destroy();
                return redirect()->to(base_url('login'));
            }
            else{
                $this->extendSession();
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->page('welcome_message');
    }

    private function page($page, $data = [])
    {
        echo view('templates/header');
        echo view($page, $data);
        echo view('templates/footer');
    }
}

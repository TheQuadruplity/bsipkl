<?php

namespace App\Controllers;

class Rekening extends BaseController
{
    public function index(){
        $this->page('daftar_rekening');
    }
}
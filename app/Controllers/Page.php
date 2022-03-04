<?php

namespace App\Controllers;

class Page extends BaseController
{

    public function index()
    {
        $this->page('dashboard');
    }

    public function pos_neraca()
    {
        $this->page('pos_neraca');
    }

    public function pos_beban()
    {
        $this->page('pos_beban');
    }

    public function pengambilan()
    {
        $this->page('pengambilan');
    }

    public function penyelesaian()
    {
        $this->page('penyelesaian');
    }

    public function daftar_beban()
    {
        $this->page('daftar_beban');
    }

    public function daftar_rekening()
    {
        $this->page('daftar_rekening');
    }
}

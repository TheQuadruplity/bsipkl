<?php

namespace App\Controllers;

class Page extends BaseController
{

    private $sidebar = [
        ['dashboard', 'Dashboard'],
        [],
        ['Pos'],
        ['pos_neraca', 'Pos Neraca'],
        ['pos_beban', 'Pos Beban'],
        [],
        ['Database'],
        ['daftar_beban', 'Daftar Beban'],
        ['daftar_rekening', 'Daftar Rekening', 'fas fa-credit-card'],

        ];

    public function index()
    {
        $this->page('dashboard');
    }


    public function dashboard()
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

    public function daftar_beban()
    {
        $this->page('daftar_beban');
    }

    public function daftar_rekening()
    {
        $this->page('daftar_rekening');
    }



    private function page($page, $data = [])
    {
        echo view('templates/header', ['data' => $this->sidebar, 'page' => $page]);
        echo view($page, $data);
        echo view('templates/footer');
    }
}

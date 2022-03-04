<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->page('welcome_message');
    }
}

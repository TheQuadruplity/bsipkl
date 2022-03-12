<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function index()
    {
        $model = new AdminModel();
        $data = $model->find()[0];
        $this->page('admin', ['data' => $data]);
    }
}

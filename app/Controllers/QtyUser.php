<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Worker_model;
use App\Models\CQModel;

class QtyUser extends BaseController
{
    public function get_Qty()
    {
        $id = $this->request->getPost("Qty_NIK");
        $pass = $this->request->getPost("pass");
        $data = [
            "title" => "Daftar NIK",
            "komik" => $this->CQModel->getCQ($id),
        ];
        print_r($data["komik"]);
        //return view('add_CQuality', $data);
    }
}

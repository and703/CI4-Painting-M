<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
    protected $DBGroup = "default";
    protected $table = "painting";
    protected $primaryKey = "id";
    protected $useTimestamps = false;
    protected $allowedFields = [
        "id",
        "WM_CODE",
        "MCH",
        "WM_NAME_WM_SURNAME",
        "MAT_DESC",
        "MAT_IP_CODE",
        "Amount",
        "On_Insert",
        "CURE_TIME",
        "Count_Printed",
        "Troley",
    ];

    public function getKomik($slug = false)
    {
        if ($slug == false) {
            return $this->orderBy("id", "DESC")->findAll(5);
        }
        return $this->where(["id" => $slug])->first();
    }
}

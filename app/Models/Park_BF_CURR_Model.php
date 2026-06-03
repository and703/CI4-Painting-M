<?php
namespace App\Models;
use CodeIgniter\Model;

class Park_BF_CURR_Model extends Model
{
    protected $DBGroup = "default";
    protected $table = "parking_bf_curr";
    protected $primaryKey = "id";
    protected $allowedFields = ["id", "id_paint", "cured_stts", "dateTIME", "MM_CODE", "WM_NAME_WM_SURNAME", "dateCURE"];

    public function getPark($id = false)
    {
        if ($id == false) {
            return $this->orderBy("id", "DESC")->findAll();
        }
        return $this->where(["id" => $id])->first();
    }
}

<?php
namespace App\Models;
use CodeIgniter\Model;

class Cured_GT_Model extends Model
{
    protected $DBGroup = "default";
    protected $table = "cured_gt";
    protected $primaryKey = "id";
    protected $allowedFields = ["id", "id_paint"];

    public function getPark($id = false)
    {
        if ($id == false) {
            return $this->orderBy("id", "DESC")->findAll();
        }
        return $this->where(["id" => $id])->first();
    }
}

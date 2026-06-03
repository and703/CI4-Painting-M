<?php
namespace App\Models;
use CodeIgniter\Model;

class ParkModel extends Model
{
    protected $DBGroup = "default";
    protected $table = "parking";
    protected $primaryKey = "id";
    protected $allowedFields = ["id", "slot", "id_paint"];

    public function getPark($id = false)
    {
        if ($id == false) {
            return $this->orderBy("id", "DESC")->findAll();
        }
        return $this->where(["id" => $id])->first();
    }
}

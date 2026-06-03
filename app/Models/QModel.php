<?php
namespace App\Models;
use CodeIgniter\Model;

class QModel extends Model
{
    protected $DBGroup = "default";
    protected $table = "cfrm_qty";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "id",
        "Qty_NIK",
        "MM_CODE",
        "Paint_id",
        "Park_id",
        "CURE_TIME",
        "dateTIME",
    ];
}

<?php
namespace App\Models;
use CodeIgniter\Model;

class MMModel extends Model
{
    protected $DBGroup = "default";
    protected $table = "mman";
    protected $primaryKey = "id";
    protected $allowedFields = ["MM_CODE", "Paint_id", "Park_id","CURE_TIME", "dateTIME"];
}

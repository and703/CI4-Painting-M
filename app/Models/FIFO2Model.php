<?php

namespace App\Models;

use CodeIgniter\Model;

class FIFO2Model extends Model
{
    protected $DBGroup = "default";
    protected $table = "fifo_park_m";
    protected $primaryKey = "id";
    protected $useTimestamps = false;
    protected $allowedFields = [
		"id", 
		"WM_CODE", 
		"WM_GROUP", 
		"WM_SHIFT", 
		"WM_NAME_WM_SURNAME", 
		"MCH", "MAT_IP_CODE", 
		"MAT_DESC", "Amount", 
		"On_Insert", 
		"CURE_TIME", 
		"Count_Printed", 
		"Park", 
		"slot", 
		"M_id",
    ];

    public function getFifo($slug = false)
    {
        if ($slug == false) {
            return $this->orderBy("id", "DESC")->findAll(5);
        }
        return $this->where(["id" => $slug])->first();
    }
}

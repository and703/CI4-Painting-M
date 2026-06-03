<?php

namespace App\Models;

use CodeIgniter\Model;

class CustAgeIP extends Model
{
	protected $DBGroup       = 'default';
    protected $table         = 'ip_cust_exp';
    protected $primaryKey    = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = [
								  'IP_CODE',
								  'Exp_Time',
								  'is_active',
								];


    public function getIpExp($slug = false)
    {
        return $this->where(['IP_CODE' => $slug])->first();
    }
}
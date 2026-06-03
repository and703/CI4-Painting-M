<?php 
namespace App\Models;
use CodeIgniter\Model;

class CQModel extends Model
{
    private $db1;
	
    public function __construct()
    {
        $this->db1 = db_connect(); // default database group
        
    }
    public function getQC($id = false)
    {
        $builder = $this->db1->table('users');
        if($id === false){
            return $builder->get();
        }else{
            return $builder->getWhere(['QC_ID' => $id]);
        }   
    }
}
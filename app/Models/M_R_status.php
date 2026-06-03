<?php

namespace App\Models; // Marking untuk model

use CodeIgniter\Model;

class M_R_status extends Model
{
    //table = deklarasikan nama tabel yg akan dipanggil
    protected $v_tbl_list_parking_status = "v_tbl_list_parking_1";
    
    
    //inconstruct
    protected $request; 
    protected $db;
    protected $db_stat;// deklarasi tabel report_movingman/ penamaan fungsi
   
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $request = \Config\Services::request();
        $this->request = $request;
        //deklartabel
        $this->db_stat = $this->db->table($this->v_tbl_list_parking_status);
		
		error_reporting(-1);
		ini_set('display_errors', '1');
       
    }
    //library

    //---------------------------------------------------------
    public function get_data()
    {
		
		//var_dump($_POST);
        $this->_get_datatables();
        if ($this->request->getPost("length") != -1){
            $this->db_stat->limit($this->request->getPost("length"), $this->request->getPost("start"));
		}
		
        $query = $this->db_stat->get();
		//var_dump($query);
        // return $query->getResult();
		return $query->getResultArray();
    }
    function _get_datatables()
    {
       
       
        
        $column_order = array('','MAT_IP_CODE','','','Park','','','On_Insert','','HOURS','',''); //field yang ada di table
        $column_search = array('IP_CODE','SLOT');
        $order = array('HOURS','desc');

        $i = 0;
        foreach ($column_search as $item) // looping awal
        {
            if ($this->request->getPost('search')['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db_stat->groupStart();
                    $this->db_stat->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->db_stat->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($column_search) - 1 == $i){
                    $this->db_stat->groupEnd();
				}
            }
            $i++;
        }
        $post_order = $this->request->getPost('order');
        if (isset($post_order)) {
            $this->db_stat->orderBy($column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db_stat->orderBy(key($order), $order[key($order)]);
        }
    }
    function count_filtered()
    {
        $this->_get_datatables();
        return $this->db_stat->countAllResults();
    }
    function count_all()
    {
        $this->_get_datatables();
        return $this->db_stat->countAllResults();
    }

}

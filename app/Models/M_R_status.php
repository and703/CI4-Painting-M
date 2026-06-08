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
        $this->db_stat = $this->db->table($this->v_tbl_list_parking_status);
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
        $column_order = array('MAT_IP_CODE','Park','On_Insert','HOURS');
        $column_search = array('IP_CODE','SLOT');

        $searchValue = $this->request->getPost('search')['value'] ?? '';
        if ($searchValue) {
            $i = 0;
            foreach ($column_search as $item) {
                if ($i === 0) {
                    $this->db_stat->groupStart();
                    $this->db_stat->like($item, $searchValue);
                } else {
                    $this->db_stat->orLike($item, $searchValue);
                }
                if (count($column_search) - 1 == $i) {
                    $this->db_stat->groupEnd();
                }
                $i++;
            }
        }

        $post_order = $this->request->getPost('order');
        if (isset($post_order)) {
            $colIndex = $post_order['0']['column'] ?? 0;
            $colName = $column_order[$colIndex] ?? '';
            if ($colName) {
                $this->db_stat->orderBy($colName, $post_order['0']['dir'] ?? 'asc');
            }
        } else {
            $this->db_stat->orderBy('HOURS', 'desc');
        }
    }

    function count_filtered()
    {
        $this->_get_datatables();
        return $this->db_stat->countAllResults();
    }

    function count_all()
    {
        return $this->db->table($this->v_tbl_list_parking_status)->countAllResults();
    }

}

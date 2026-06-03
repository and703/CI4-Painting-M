<?php

namespace App\Models; // Marking untuk model

use CodeIgniter\Model;

class M_Report_parking extends Model
{
    //table = deklarasikan nama tabel yg akan dipanggil
    protected $v_parking_filled = "v_parking_filled";
    
    
    
    //inconstruct
    protected $request; 
    protected $db;
    protected $db_park;// deklarasi tabel parking/ penamaan fungsi
    
   
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $request = \Config\Services::request();
        $this->request = $request;
        //deklartabel
        $this->db_park = $this->db->table($this->v_parking_filled);
       
       
    }
    //library

    //---------------------------------------------------------
    public function get_data()
    {
        $this->_get_datatables();
        if ($this->request->getPost("length") != -1)
            $this->db_park->limit($this->request->getPost("length"), $this->request->getPost("start"));
        $query = $this->db_park->get();
        return $query->getResult();
    }
    function _get_datatables()
    {

        $column_order = array('','MAT_IP_CODE','','slot','Amount','On_Insert','CURE_TIME'); //field yang ada di table
        $column_search = array('MAT_IP_CODE','slot');
        $order = array('id','desc');

        $i = 0;
        foreach ($column_search as $item) // looping awal
        {
            if ($this->request->getPost('search')['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db_park->groupStart();
                    $this->db_park->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->db_park->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($column_search) - 1 == $i)
                    $this->db_park->groupEnd();
            }
            $i++;
        }
        $post_order = $this->request->getPost('order');
        if (isset($post_order)) {
            $this->db_park->orderBy($column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db_park->orderBy(key($order), $order[key($order)]);
        }
    }
    function count_filtered()
    {
        $this->_get_datatables();
        return $this->db_park->countAllResults();
    }
    function count_all()
    {
        $this->_get_datatables();
        return $this->db_park->countAllResults();
    }
//ini library
 
function rangeindo($tgl, $ambil) //unuk database
	{
		//30/03/2016 - 23/05/2016
		$tglORI = explode(" - ", $tgl);
		$tglAwal = explode("/", $tglORI[$ambil]);
		$tgl1 = $tglAwal[0] . "/" . $tglAwal[1] . "/" . $tglAwal[2];
		return $tgl1;
	}


}

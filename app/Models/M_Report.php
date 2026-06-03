<?php

namespace App\Models; // Marking untuk model

use CodeIgniter\Model;

class M_Report extends Model
{
    //table = deklarasikan nama tabel yg akan dipanggil
    protected $report_movingman = "report_movingman";
    
    
    //inconstruct
    protected $request; 
    protected $db;
    protected $db_rm;// deklarasi tabel report_movingman/ penamaan fungsi
   
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $request = \Config\Services::request();
        $this->request = $request;
        //deklartabel
        $this->db_rm = $this->db->table($this->report_movingman);
       
    }
    //library

    //---------------------------------------------------------
    public function get_data()
    {
        $this->_get_datatables();
        if ($this->request->getPost("length") != -1)
            $this->db_rm->limit($this->request->getPost("length"), $this->request->getPost("start"));
        $query = $this->db_rm->get();
        return $query->getResult();
    }
    function _get_datatables()
    {
       
       
        // $this->db_rm->where("mat_code!=","mat_code");
       

         $f1=$this->request->getPost("f1");
		
        
        if($f1)
		{
			$tgl1 = $this->rangeindo($f1, 0);
			$tgl2 = $this->rangeindo($f1, 1);
            $this->db_rm->where("SUBSTR(CheckOut,1,10)>=", $tgl1);
            $this->db_rm->where("SUBSTR(CheckOut,1,10)<=", $tgl2);
		}

        $f2=$this->request->getPost("f2");
		
         if($f2)

		 {
             if($f2==1)
             {
                $this->db_rm->where("SUBSTR(CheckOut,12,12)>=",'00.00'); 
                $this->db_rm->where("SUBSTR(CheckOut,12,12)<=",'07.59'); 
             }
			
             if($f2==2)
             {
                $this->db_rm->where("SUBSTR(CheckOut,12,12)>=",'08.00'); 
                $this->db_rm->where("SUBSTR(CheckOut,12,12)<=",'15.59'); 
             }
			
             if($f2==3)
             {
                $this->db_rm->where("SUBSTR(CheckOut,12,12)>=",'16.00'); 
                $this->db_rm->where("SUBSTR(CheckOut,12,12)<=",'23.59'); 
             }

		}
		

        $column_order = array('','','IP_CODE','','Parked','Amount','CheckOut'); //field yang ada di table
        $column_search = array('IP_CODE','Parked');
        $order = array('id','desc');

        $i = 0;
        foreach ($column_search as $item) // looping awal
        {
            if ($this->request->getPost('search')['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db_rm->groupStart();
                    $this->db_rm->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->db_rm->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($column_search) - 1 == $i)
                    $this->db_rm->groupEnd();
            }
            $i++;
        }
        $post_order = $this->request->getPost('order');
        if (isset($post_order)) {
            $this->db_rm->orderBy($column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db_rm->orderBy(key($order), $order[key($order)]);
        }
    }
    function count_filtered()
    {
        $this->_get_datatables();
        return $this->db_rm->countAllResults();
    }
    function count_all()
    {
        $this->_get_datatables();
        return $this->db_rm->countAllResults();
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

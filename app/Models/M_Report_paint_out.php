<?php

namespace App\Models; // Marking untuk model

use CodeIgniter\Model;

class M_Report_paint_out extends Model
{
    //table = deklarasikan nama tabel yg akan dipanggil
    protected $v_tbl_checkout_1 = "v_tbl_checkout_1";
    
    
    //inconstruct
    protected $request; 
    protected $db;
    protected $db_rpot;// deklarasi tabel report_movingman/ penamaan fungsi
   
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $request = \Config\Services::request();
        $this->request = $request;
        //deklartabel
        $this->db_rpot = $this->db->table($this->v_tbl_checkout_1);
       
    }
    //library

    //---------------------------------------------------------
    public function get_data()
    {
        $this->_get_datatables();
        if ($this->request->getPost("length") != -1)
            $this->db_rpot->limit($this->request->getPost("length"), $this->request->getPost("start"));
        $query = $this->db_rpot->get();
        return $query->getResult();
    }
    function _get_datatables()
    {
       
       
        // $this->db_rpot->where("mat_code!=","mat_code");
       

        $f1=$this->request->getPost("f1");
		
        
        if($f1)
		{
			$tgl1 = $this->rangeindo($f1, 0);
			$tgl2 = $this->rangeindo($f1, 1);
            $this->db_rpot->where("CAST(CHECKOUT_TIME AS DATE)>=", $tgl1);
            $this->db_rpot->where("CAST(CHECKOUT_TIME AS DATE)<=", $tgl2);
		}

        $f2=$this->request->getPost("f2");
		
         if($f2)

		 {
             if($f2==1)
             {
                $this->db_rpot->where("CAST(CHECKOUT_TIME AS TIME) BETWEEN '00:00' and '08:00'", NULL, FALSE ); 
             }
			
             if($f2==2)
             {
                $this->db_rpot->where("CAST(CHECKOUT_TIME AS TIME) BETWEEN '08:00' and '16:00'", NULL, FALSE ); 
             }
			
             if($f2==3)
             {
                $this->db_rpot->where("CAST(CHECKOUT_TIME AS TIME) BETWEEN '16:00' and '23:59'", NULL, FALSE ); 
             }

		}
		

        $column_order = array('IP_CODE', 'MAT_DESC', 'MCH', 'AMOUNT', 'SLOT', 'USERNAME', 'GROUP_PAINT', 'SHIFT', 'PRINT_OUT', 'HOURS', 'EXPIRED_TIME', 'CURE_TIME', 'CHECKOUT_TIME'); //field yang ada di table
        $column_search = array('IP_CODE','SLOT');
        //$order = array('PRINT_OUT','ASC');

        $i = 0;
        foreach ($column_search as $item) // looping awal
        {
            if ($this->request->getPost('search')['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db_rpot->groupStart();
                    $this->db_rpot->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->db_rpot->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($column_search) - 1 == $i)
                    $this->db_rpot->groupEnd();
            }
            $i++;
        }
        $post_order = $this->request->getPost('order');
        if (isset($post_order)) {
            $this->db_rpot->orderBy($column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db_rpot->orderBy(key($order), $order[key($order)]);
        }
    }
    function count_filtered()
    {
        $this->_get_datatables();
        return $this->db_rpot->countAllResults();
    }
    function count_all()
    {
        $this->_get_datatables();
        return $this->db_rpot->countAllResults();
    }
//ini library
function rangeindo($tgl, $ambil) //unuk database
	{
		//30/03/2016 - 23/05/2016
		$tglORI = explode(" - ", $tgl);
		$tglAwal = explode("/", $tglORI[$ambil]);
		$tgl1 = $tglAwal[2] . "-" . $tglAwal[1] . "-" . $tglAwal[0];
		return $tgl1;
	}


}

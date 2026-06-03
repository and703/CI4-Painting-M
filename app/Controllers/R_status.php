<?php

namespace App\Controllers;

class R_status extends BaseController
{

	// Deklarasikan tabel dan service yg akan dipakai
	/*model*/
	protected $M_R_status;
	//inconstruct
	protected $request; // pengganti this input untuk get parameter yg dipost dan diget
	protected $db; // untuk database deklarasi tabel
	//plugin
	protected $Dompdf;

	// deklarasikan semua
	public function __construct()
	{
		$this->mdl = new \App\Models\M_R_status(); //load model terlebih dahulu
		$this->db = \Config\Database::connect(); // load services koneksi database
		$request = \Config\Services::request(); // load services request
		$this->request = $request;
		
		error_reporting(-1);
		ini_set('display_errors', '1');
	}

	

	public function index()
	{
		
		echo view('v_r_status');
		//echo view('v_report_paint') ;
	}


	function data_tables()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $this->request->getPost("start");
		$no = $no + 1;
		//var_dump($list); die;
		foreach ($list as $v) {
			
			/*
			$id=isset($v->id)?($v->id):'';
			$ipcode=isset($v->IP_CODE)?($v->IP_CODE):'';
			$mch=isset($v->MCH)?($v->MCH):'';
			$matdesc=isset($v->MAT_DESC)?($v->MAT_DESC):'';
			$parkir=isset($v->SLOT)?($v->SLOT):'';
			$jumlah=isset($v->AMOUNT)?($v->AMOUNT):'';
			$operator=isset($v->USERNAME)?($v->USERNAME):'';
			$printout=isset($v->PRINT_OUT)?($v->PRINT_OUT):'';
			$curetime=isset($v->CURE_TIME)?($v->CURE_TIME):'';
			$hours=isset($v->HOURS)?($v->HOURS):'';
			$expired=isset($v->EXPIRED_TIME)?($v->EXPIRED_TIME):'';
			*/
			
			
			$id=isset($v['id'])?($v['id']):'';
			$ipcode=isset($v['IP_CODE'])?($v['IP_CODE']):'';
			$mch=isset($v['MCH'])?($v['MCH']):'';
			$matdesc=isset($v['MAT_DESC'])?($v['MAT_DESC']):'';
			$parkir=isset($v['SLOT'])?($v['SLOT']):'';
			$jumlah=isset($v['AMOUNT'])?($v['AMOUNT']):'';
			$operator=isset($v['USERNAME'])?($v['USERNAME']):'';
			$printout=isset($v['PRINT_OUT'])?($v['PRINT_OUT']):'';
			$curetime=isset($v['CURE_TIME'])?($v['CURE_TIME']):'';
			$hours=isset($v['HOURS'])?($v['HOURS']):'';
			$expired=isset($v['EXPIRED_TIME'])?($v['EXPIRED_TIME']):'';
			
			//$gtstatus=isset($v->GT_STATUS)?($v->GT_STATUS):'';
		
			$row = array();
			$row[] = "<span class='size'  >".$no++."</span>";	
			// $row[] = "<a href='javascript:void(0)' class='size linehover' onclick='view(`".$id."`)'>".$mat_code." </a>";
			$row[] = "<span class='size' >".$ipcode."</span>";
			$row[] = "<span class='size' >".$mch."</span>";	
			$row[] = "<p class='size' style='text-align:center'>".$matdesc."</p>";
			$row[] = "<span class='size' >".$parkir."</span>";
			$row[] = $jumlah;
			$row[] = "<span class='size' >".$operator."</span>";
			$row[] = "<span class='size' >".$printout."</span>";
			$row[] = "<span class='size' >".$curetime."</span>";
			$row[] = "<span class='size' >  ".$hours." </span>";		
			$row[] = "<span class='size' >".$expired."</span>";
			//$row[] = $gtstatus;	
							
			//$row[] = "<span class='size' >  ".$profilename."</span>";
			//add html for action
			$data[] = $row;

		}
		
		//return json_encode($data);
		$output = array(
			"draw" => $this->request->getPost("draw"),
			"recordsTotal" => $this->mdl->count_all(),
			"recordsFiltered" => $this->mdl->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

}

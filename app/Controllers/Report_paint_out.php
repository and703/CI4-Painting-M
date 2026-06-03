<?php

namespace App\Controllers;

class Report_paint_out extends BaseController
{

	// Deklarasikan tabel dan service yg akan dipakai
	/*model*/
	protected $M_Report_paint_out;
	//inconstruct
	protected $request; // pengganti this input untuk get parameter yg dipost dan diget
	protected $db; // untuk database deklarasi tabel
	//plugin
	protected $Dompdf;

	// deklarasikan semua
	public function __construct()
	{
		$this->mdl = new \App\Models\M_Report_paint_out(); //load model terlebih dahulu
		$this->db = \Config\Database::connect(); // load services koneksi database
		$request = \Config\Services::request(); // load services request
		$this->request = $request;
	}

	

	public function index()
	{
		echo view('v_report_paint_out') ;
		//echo view('v_report_paint') ;
	}


	function data_tables()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $this->request->getPost("start");
		$no = $no + 1;
		foreach ($list as $v) {

			$ipcode=isset($v->IP_CODE)?($v->IP_CODE):'';
			$matdesc=isset($v->MAT_DESC)?($v->MAT_DESC):'';
			$jumlah=isset($v->AMOUNT)?($v->AMOUNT):'';
			$parkir=isset($v->SLOT)?($v->SLOT):'';
			$printout=isset($v->PRINT_OUT)?($v->PRINT_OUT):'';
		
			$operator=isset($v->USERNAME)?($v->USERNAME):'';
			$group=isset($v->GROUP_PAINT)?($v->GROUP_PAINT):'';
			$shift=isset($v->SHIFT)?($v->SHIFT):'';
			$expired_time=isset($v->EXPIRED_TIME)?($v->EXPIRED_TIME):'';
			$cure_time=isset($v->CURE_TIME)?($v->CURE_TIME):'';
			$checkout_time=isset($v->CHECKOUT_TIME)?($v->CHECKOUT_TIME):'';
		
			$row = array();
			$row[] = $no++;	
			// $row[] = "<a href='javascript:void(0)' class='size linehover' onclick='view(`".$id."`)'>".$mat_code." </a>";
			$row[] = $ipcode;	
			$row[] = $matdesc;
			$row[] = $jumlah;
			$row[] = $parkir;
			$row[] = $printout;
		
			$row[] = $operator;
			$row[] = $group;
			$row[] = $shift;	
			$row[] = $expired_time;	
			$row[] = $cure_time;	
			$row[] = $checkout_time;	
							
			//$row[] = "<span class='size' >  ".$profilename."</span>";
			//add html for action
			$data[] = $row;

		}
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

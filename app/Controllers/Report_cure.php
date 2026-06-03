<?php

namespace App\Controllers;

class Report_cure extends BaseController
{

	// Deklarasikan tabel dan service yg akan dipakai
	/*model*/
	protected $M_Report_cure;
	//inconstruct
	protected $request; // pengganti this input untuk get parameter yg dipost dan diget
	protected $db; // untuk database deklarasi tabel
	//plugin
	protected $Dompdf;

	// deklarasikan semua
	public function __construct()
	{
		$this->mdl = new \App\Models\M_Report_cure(); //load model terlebih dahulu
		$this->db = \Config\Database::connect(); // load services koneksi database
		$request = \Config\Services::request(); // load services request
		$this->request = $request;
	}

	

	public function index()
	{
		echo view('v_Report_cure') ;
		//echo view('v_report_paint') ;
	}


	function data_tables()
	{
		$list = $this->mdl->get_data();
		$data = array();
		foreach ($list as $v) {

			$MM_CODE=isset($v->MM_CODE)?($v->MM_CODE):'';
			$MAT_IP_CODE=isset($v->MAT_IP_CODE)?($v->MAT_IP_CODE):'';
			$MAT_DESC=isset($v->MAT_DESC)?($v->MAT_DESC):'';
			$Amount=isset($v->Amount)?($v->Amount):'';
			$Park=isset($v->Park)?($v->Park):'';
		
			$CURE_TIME=isset($v->CURE_TIME)?($v->CURE_TIME):'';
			$cured_stts=isset($v->cured_stts)?($v->cured_stts):'';
			$actual_cure=isset($v->actual_cure)?($v->actual_cure):'';
		
			$row = array();
			$row[] = $no++;	
			// $row[] = "<a href='javascript:void(0)' class='size linehover' onclick='view(`".$id."`)'>".$mat_code." </a>";
			$row[] = $MM_CODE;	
			$row[] = $MAT_IP_CODE;
			$row[] = $MAT_DESC;
			$row[] = $Amount;
			$row[] = $Park;
		
			$row[] = $CURE_TIME;
			$row[] = $cured_stts;
			$row[] = $actual_cure;		
							
			//$row[] = "<span class='size' >  ".$profilename."</span>";
			//add html for action
			$data[] = $row;

		}
		$output = array(
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

}

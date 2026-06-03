<?php

namespace App\Controllers;

class Report_paint extends BaseController
{

	// Deklarasikan tabel dan service yg akan dipakai
	/*model*/
	protected $M_Report_paint;
	//inconstruct
	protected $request; // pengganti this input untuk get parameter yg dipost dan diget
	protected $db; // untuk database deklarasi tabel
	//plugin
	protected $Dompdf;

	// deklarasikan semua
	public function __construct()
	{
		$this->mdl = new \App\Models\M_Report_paint(); //load model terlebih dahulu
		$this->db = \Config\Database::connect(); // load services koneksi database
		$request = \Config\Services::request(); // load services request
		$this->request = $request;
	}

	

	public function index()
	{
		echo view('v_report_paint') ;
		//echo view('v_report_paint') ;
	}


	function data_tables()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $this->request->getPost("start");
		$no = $no + 1;
		foreach ($list as $v) {

			$id=isset($v->id)?($v->id):'';
			$mch=isset($v->MCH)?($v->MCH):'';
			$ipcode=isset($v->IP_CODE)?($v->IP_CODE):'';
			$matdesc=isset($v->MAT_DESC)?($v->MAT_DESC):'';
			$jumlah=isset($v->AMOUNT)?($v->AMOUNT):'';
			$parkir=isset($v->SLOT)?($v->SLOT):'';
			$printout=isset($v->PRINT_OUT)?($v->PRINT_OUT):'';
		
			$operator=isset($v->USERNAME)?($v->USERNAME):'';
			$group=isset($v->GROUP_PAINT)?($v->GROUP_PAINT):'';
			$shift=isset($v->SHIFT)?($v->SHIFT):'';
		
			$row = array();
			$row[] = $no++;	
			// $row[] = "<a href='javascript:void(0)' class='size linehover' onclick='view(`".$id."`)'>".$mat_code." </a>";
			$row[] = $mch;
			$row[] = $ipcode;	
			$row[] = $matdesc;
			$row[] = $jumlah;
			$row[] = $parkir;
			$row[] = $printout;
		
			$row[] = $operator;
			$row[] = $group;
			$row[] = $shift;	
							
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

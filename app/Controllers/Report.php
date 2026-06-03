<?php

namespace App\Controllers;

class Report extends BaseController
{

	// Deklarasikan tabel dan service yg akan dipakai
	/*model*/
	protected $M_Report;
	//inconstruct
	protected $request; // pengganti this input untuk get parameter yg dipost dan diget
	protected $db; // untuk database deklarasi tabel
	//plugin
	protected $Dompdf;

	// deklarasikan semua
	public function __construct()
	{
		$this->mdl = new \App\Models\M_Report(); //load model terlebih dahulu
		$this->db = \Config\Database::connect(); // load services koneksi database
		$request = \Config\Services::request(); // load services request
		$this->request = $request;
	}

	

	public function index()
	{
		
 echo view('v_report') ;
	}


	function data_tables()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $this->request->getPost("start");
		$no = $no + 1;
		foreach ($list as $v) {

			$id=isset($v->id)?($v->id):'';
			$kode_mesin=isset($v->Code_Machine)?($v->Code_Machine):'';
			$ipcode=isset($v->IP_CODE)?($v->IP_CODE):'';
			$matdesc=isset($v->MAT_DESC)?($v->MAT_DESC):'';
			$parkir=isset($v->Parked)?($v->Parked):'';
			$jumlah=isset($v->Amount)?($v->Amount):'';
			$tgl_checkout=isset($v->CheckOut)?($v->CheckOut):'';
		
			$row = array();
			$row[] = "<span class='size'  >".$no++."</span>";	
			// $row[] = "<a href='javascript:void(0)' class='size linehover' onclick='view(`".$id."`)'>".$mat_code." </a>";
			$row[] = "<span class='size' >".$kode_mesin."</span>";	
			$row[] = "<p class='size' style='text-align:center'>".$ipcode."</p>";
			$row[] = "<span class='size' >".$matdesc."</span>";
			$row[] = "<span class='size' >".$parkir."</span>";
			$row[] = "<span class='size' >".$jumlah."</span>";
			$row[] = "<span class='size' >  ".$tgl_checkout." </span>";		
							
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

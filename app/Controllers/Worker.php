<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\Worker_model;
use App\Models\KomikModel;
use App\Models\CustAgeIP;
use App\Models\ParkModel;
use App\Models\Park_M_Model;
use App\Models\MMModel;
use App\Models\CQModel;
use App\Models\QModel;

class Worker extends Controller
{
    public function index()
    {
        $data["title"] = "Input Nik";
        echo view("worker_view", $data);
    }
	
	public function api_jumlah(){
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin,X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE");
		$model = new Worker_model();
		return json_encode($model->ajaxPaint());
	}

    public function mch_log()
    {
        $data["title"] = "Input Machine Code";
        echo view("C_U/GT_IP_view", $data);
    }

    public function MM_log()
    {
        $data["title"] = "Input Machine Code";
        echo view("C_U/MM_log", $data);
    }

    public function park_view()
    {
        $data["title"] = "Parking View";
        echo view("C_U/Park", $data);
    }

    public function park_cure()
    {
        $data["title"] = "Parking View Curring";
        echo view("C_U/Park_BF_CURR", $data);
    }

    public function stock()
    {
        $data["title"] = "Stock_View";
        echo view("C_U/Stock", $data);
    }

    public function t_stock()
    {
        $data["title"] = "Stock_Total";
        echo view("C_U/T_Stock", $data);
    }

    public function park_Show()
    {
        $data["title"] = "Parking Monitor";
        echo view("C_U/Park_m", $data);
    }

    public function worker()
    {
        $data["title"] = "Painting Login";
        echo view("worker_view", $data);
    }
    
    public function get_nik_mm()
    {
        $session = session();
        $id = $this->request->getPost('WM_CODE');
        $pass = $this->request->getPost('Pass');
        if($id == 'irhamkh002'){
			$ses_data = [
				'MM_CODE'       => $id,
				'MM_NAME'     	=> 'Irham',
				'MM_SURNAME'    => 'Khairuman, ID',
				'logged_in_mm'  => '1'
			];
			$session->set($ses_data);
            return redirect()->to('park_view');
        }elseif($pass != ''){
			$md4 = new CQModel();
			$data['QC'] = $md4->getQC($id)->getRow();
			$dt = json_decode(json_encode($data["QC"]), true);
			if (password_verify($pass, $dt["pass"])) {
				$ses_data = [
					'MM_CODE'       => $id,
					'MM_NAME'     	=> $dt['Full_Name'],
					'logged_in_qc'  => '1'
				];
				$session->set($ses_data);
				return redirect()->to('park_view');
			} else {
				return redirect()->to('park_view');
			}
        }else{
			$model = new Worker_model();
            $data['park'] = $model->getWorker($id)->getRow();
            $dt = json_decode(json_encode($data['park']), true);
            if($dt){
                $ses_data = [
                    'MM_CODE'       => $dt['WM_CODE'],
                    'MM_NAME'     	=> $dt['WM_NAME'],
                    'MM_SURNAME'    => $dt['WM_SURNAME'],
                    'logged_in_mm'  => '1'
                ];
                $session->set($ses_data);
                return redirect()->to('park_view');
            }else{
                session()->setFlashdata('pesan', 'Login Gagal Nik : '.$id.' Tidak terdaftar');
                return redirect()->to('park_log');
            }
        }
    }
 
    public function logout_MM()
    {
        $session = session();
        $session->destroy();
        $data["title"] = "Painting Park";
        return redirect()->to("parking");
    }

    public function get_nik()
    {
        $session = session();
        $model = new Worker_model();
        $id = $this->request->getPost("WM_CODE");
        $group = $this->request->getPost("GROUP");
        $shift = $this->request->getPost("SHIFT");
        $data["painting"] = $model->getWorker($id)->getRow();
        $dt = json_decode(json_encode($data["painting"]), true);
        if ($dt) {
            $ses_data = [
                "WM_CODE" => $dt["WM_CODE"],
                "GROUP" => "" . $group . "",
                "SHIFT" => "" . $shift . "",
                "WM_NAME" => $dt["WM_NAME"],
                "WM_SURNAME" => $dt["WM_SURNAME"],
                "logged_in_wm" => "1",
            ];
            $session->set($ses_data);
            $data["title"] = "Input Machine Code";
            echo view("C_U/GT_IP_view", $data);
        } else {
            session()->setFlashdata(
                "pesan",
                "Login Gagal Nik : " . $id . " Tidak terdaftar"
            );
            return redirect()->to("worker");
        }
    }

    public function logout_WM()
    {
        $session = session();
        $session->destroy();
        $data["title"] = "Painting Park";
        return redirect()->to("");
    }

    public function logout_CURE()
    {
        $session = session();
        $session->destroy();
        $data["title"] = "CURRING";
        return redirect()->to("/cure");
    }

    public function get_mch()
    {
        $session = session();
        $model = new Worker_model();
        $id = $this->request->getPost("WM_CODE");
        $data["mch"] = $this->request->getPost("mch");
        $data["worker"] = $model->getWorker($id)->getRow();
        $data["title"] = "Input GT IPCode";
        echo view("C_U/GT_IP_view", $data);
    }

    public function cure_log()
    {
        $session = session();
        $model = new Worker_model();
        $id = $this->request->getPost("WM_CODE");
        $group = $this->request->getPost("GROUP");
        $shift = $this->request->getPost("SHIFT");
        $data["painting"] = $model->getWorker($id)->getRow();
        $dt = json_decode(json_encode($data["painting"]), true);
        if ($dt) {
            $ses_data = [
                "WM_CODE" => $dt["WM_CODE"],
                "GROUP" => "" . $group . "",
                "SHIFT" => "" . $shift . "",
                "WM_NAME" => $dt["WM_NAME"],
                "WM_SURNAME" => $dt["WM_SURNAME"],
                "logged_in_cm" => "1",
            ];
            $session->set($ses_data);
            $data["title"] = "Input Machine Code";
            echo view("C_U/cure_mch", $data);
        } else {
            session()->setFlashdata(
                "pesan",
                "Login Gagal Nik : " . $id . " Tidak terdaftar"
            );
            return redirect()->to("cure");
        }
    }

    public function get_cure_mch()
    {
        $md1 = new KomikModel();
        $model = new Worker_model();
        $md4 = new Park_BF_CURR_Model();
        // $MCH = $this->request->getPost("MCH");
        $TAG = $this->request->getPost("TAG");
        $id_TAG = explode(",", $TAG);
        // $id_MCH = explode(",", $MCH);

        $array = ["id_paint" => $id_TAG[4]];
        // $data["park"] = $md4->where($array)->first();
        $dt1 = $md1->where("id", $id_TAG[4])->first();
        
        // $dt2 = $model->getMch($id_MCH[0],$id_MCH[1],$dt1["MAT_IP_CODE"]);
        // $dt2     = json_decode(json_encode($dt2), true);
        $data     = [
            "title" => "Tag Confirm",
            "painting"     => $dt1,
            "message"     => "",
        ];
		
/*         $data     = [
            "title" => "Tag Confirm",
            "painting"     => $dt1,
            "MCH"     => $dt2,
            "message"     => "",
        ]; */

        $data["title"] = "Tag CURE Confirm";
        $data["message"] = "";
        echo view("C_U/CURE_GT_MCH_conf", $data);
    }

    public function cure_conf()
    {
        $session = session();
        $md4 = new Park_BF_CURR_Model();
        $dateTime = date("d/m/Y H.i");

        $MM_CODE = $this->request->getPost("WM_CODE");
        $paint_id = $this->request->getPost("id");
        $MAT_CODE = $this->request->getPost("MAT_CODE");

        $array = ["id_paint" => $paint_id, "cured_stts" => "UNCURED"];
        $dt_cure_stts = $md4->where($array)->first();
        // tampilkan 404 error jika data tidak ditemukan

		$WM_NAME_WM_SURNAME = $session->get("WM_NAME") . " " . $session->get("WM_SURNAME");
        if (!$dt_cure_stts) {
            throw new PageNotFoundException(
                "Park " . $MAT_CODE . " Tidak di temukan / Sudah CURED"
            );
        } else {
            $dt_cure_id = $dt_cure_stts["id"];
            $dt = [
                "cured_stts" => "CURED",
                "MM_CODE" => $MM_CODE,
                "WM_NAME_WM_SURNAME" => $WM_NAME_WM_SURNAME,
                "dateCURE" => $dateTime,
            ];

            $md4->update($dt_cure_id, $dt);

            return redirect()->to("cure");
        }
    }
    

    public function get_ip()
    {
        $session = session();
        $model = new Worker_model();
        $md = new CustAgeIP();
        $md1 = new KomikModel();
        $MAT_IP_CODE = $this->request->getPost("MAT_IP_CODE");
        $id = $this->request->getPost("id");
        if($MAT_IP_CODE == 'i'){
            $data["painting"] 		= $md1->where("id", $id)->first();
			$data["gt_ip"] 			= $model->getGtip($data["painting"]["MAT_IP_CODE"])->getRow();
			
			$dt = $md->getIpExp($data["painting"]["MAT_IP_CODE"]);
			if($dt){
				$data["AG_time"] 	= $dt['Exp_Time'];
			}else{
				$data["AG_time"] 	= '0';
			}
			$data["title"] 			= "Input Amount GT";
			echo view("C_U/input_amount_m2", $data);

        }elseif($MAT_IP_CODE == 'r'){
            $data["painting"] 		= $md1->where("id", $id)->first();
			$data["gt_ip"] 			= $model->getGtip($data["painting"]["MAT_IP_CODE"])->getRow();
			
			$dt = $md->getIpExp($data["painting"]["MAT_IP_CODE"]);
			if($dt){
				$data["AG_time"] 	= $dt['Exp_Time'];
			}else{
				$data["AG_time"] 	= '0';
			}
			$data["title"] 			= "Input Amount GT REBOIACCA";
			echo view("C_U/input_amount_re", $data);

        }else{
            $data["mch"] = $this->request->getPost("mch");
            $data["gt_ip"] = $model->getGtip($MAT_IP_CODE)->getRow();
            $dt = $md->getIpExp($MAT_IP_CODE);
            if($dt){
                $data["AG_time"] = $dt['Exp_Time'];
            }else{
                $data["AG_time"] = '0';
            }
            $data["title"] = "Input Amount GT";
            echo view("C_U/input_amount", $data);
            //print_r($data);
        }
    }

    public function save()
    {
        $session = session();
        $md1 = new KomikModel();
        if(strncmp($this->request->getPost("mch"), "A", 1) === 0){
            if($this->request->getPost("mch") == "A1_RE"){
                $md2                            = new ParkModel();
                if (($dt["park"] = $md2->where("id_paint", "0")->first())) {
                    $slot 						= $dt["park"]["slot"];
                    $startTime 					= date("d/m/Y H.i");
                    if($this->request->getPost("AG_time") == '0'){
                        $cenvertedTime 			= date("d/m/Y H.i", strtotime("+2 hours"));
                    }else {
                        $id 					= $this->request->getPost("id");
                        $list 					= $this->request->getPost("AG_time");
                        $timepicker 			= explode(":", $list);
                        $hours 					= $timepicker[0];
                        $minute 				= $timepicker[1];
                        
                        $cenvertedTime 		    = date("d/m/Y H.i", strtotime("+".$hours." hours +".$minute." minutes"));
                    }
                    $WM_NAME_WM_SURNAME 		= $session->get("WM_NAME") . " " . $session->get("WM_SURNAME");
                    $model 						= new Worker_model();
                    $data 						= [
                        "WM_CODE" 				=> $session->get("WM_CODE"),
                        "WM_GROUP" 				=> $session->get("GROUP"),
                        "WM_SHIFT" 				=> $session->get("SHIFT"),
                        "WM_NAME_WM_SURNAME" 	=> $WM_NAME_WM_SURNAME,
					    "MCH" 					=> $this->request->getPost("mch1"),
                        "MAT_DESC" 				=> $this->request->getPost("MAT_DESC"),
                        "MAT_IP_CODE" 			=> $this->request->getPost("MAT_IP_CODE"),
                        "Amount" 				=> $this->request->getPost("Amount"),
                        "On_Insert" 			=> $startTime,
                        "CURE_TIME" 			=> $cenvertedTime,
                        "Count_Printed" 		=> $this->request->getPost("Count_Printed"),
                        "Park" 					=> $slot,
					    "Re" 					=> $this->request->getPost("id"),
                    ];
                    $model->savePrint($data);

                    $data["painting"] 			= $md1->orderBy("id", "DESC")->first();
                    $id 						= $data["painting"]["id"];
                    $slot 						= $data["painting"]["Park"];
                    $data["park"] 				= $md2->where("slot", $slot)->first();
                    $dtid 						= $data["park"]["id"];
                    $dt 						= [
                        "id_paint" 				=> $id,
                    ];
                    
                    $md2->update($dtid, $dt);
                    return redirect()->to("p_reb/" . $id);
                } 
                else {
                    throw new \CodeIgniter\Database\Exceptions\DatabaseException();
                }
            }else{
			    $md2 							= new ParkModel();
                if (($dt["park"] = $md2->where("id_paint", "0")->first())) {
                    $slot 						= $dt["park"]["slot"];
                    $startTime 					= date("d/m/Y H.i");
                    if($this->request->getPost("AG_time") == '0'){
                        $cenvertedTime 			= date("d/m/Y H.i", strtotime("+2 hours"));
                    }else {
                        $id 					= $this->request->getPost("id");
                        $list 					= $this->request->getPost("AG_time");
                        $timepicker 			= explode(":", $list);
                        $hours 					= $timepicker[0];
                        $minute 				= $timepicker[1];
                        
                        $cenvertedTime 		    = date("d/m/Y H.i", strtotime("+".$hours." hours +".$minute." minutes"));
                    }
                    $WM_NAME_WM_SURNAME 		= $session->get("WM_NAME") . " " . $session->get("WM_SURNAME");
                    $model 						= new Worker_model();
                    $data 						= [
                        "WM_CODE" 				=> $session->get("WM_CODE"),
                        "WM_GROUP" 				=> $session->get("GROUP"),
                        "WM_SHIFT" 				=> $session->get("SHIFT"),
                        "MCH" 					=> $this->request->getPost("mch"),
                        "WM_NAME_WM_SURNAME" 	=> $WM_NAME_WM_SURNAME,
                        "MAT_DESC" 				=> $this->request->getPost("MAT_DESC"),
                        "MAT_IP_CODE" 			=> $this->request->getPost("MAT_IP_CODE"),
                        "Amount" 				=> $this->request->getPost("Amount"),
                        "On_Insert" 			=> $startTime,
                        "CURE_TIME" 			=> $cenvertedTime,
                        "Count_Printed" 		=> $this->request->getPost("Count_Printed"),
                        "Park" 					=> $slot,
                    ];
                    $model->savePrint($data);

                    $data["painting"] 			= $md1->orderBy("id", "DESC")->first();
                    $id 						= $data["painting"]["id"];
                    $slot 						= $data["painting"]["Park"];
                    $data["park"] 				= $md2->where("slot", $slot)->first();
                    $dtid 						= $data["park"]["id"];
                    $dt 						= [
                        "id_paint" 				=> $id,
                    ];
                    
                    $md2->update($dtid, $dt);
                    return redirect()->to("print/" . $id);
                } 
                else {
                    throw new \CodeIgniter\Database\Exceptions\DatabaseException();
                }
            }

		}elseif(strncmp($this->request->getPost("mch"), "M", 1) === 0){
            if($this->request->getPost("mch") == "M3"){
                $md2 = new Park_B_Model();
            }else{
                $md2 = new Park_M_Model();
            }
			
			if (($dt["park"] = $md2->where("id_paint", "0")->first())) {
				$slot 						= $dt["park"]["slot"];
				$startTime 					= date("d/m/Y H.i");
				if($this->request->getPost("AG_time") == '0'){
					$cenvertedTime 			= date("d/m/Y H.i", strtotime("+2 hours"));
				}else {
					$id 					= $this->request->getPost("id");
					$list 					= $this->request->getPost("AG_time");
					$timepicker 			= explode(":", $list);
					$hours 					= $timepicker[0];
					$minute 				= $timepicker[1];
					
					$cenvertedTime 		= date("d/m/Y H.i", strtotime("+".$hours." hours +".$minute." minutes"));
				}
				$WM_NAME_WM_SURNAME 		= $session->get("WM_NAME") . " " . $session->get("WM_SURNAME");
				$model 						= new Worker_model();
				$data 						= [
					"WM_CODE" 				=> $session->get("WM_CODE"),
					"WM_GROUP" 				=> $session->get("GROUP"),
					"WM_SHIFT" 				=> $session->get("SHIFT"),
					"MCH" 					=> $this->request->getPost("mch"),
					"WM_NAME_WM_SURNAME" 	=> $WM_NAME_WM_SURNAME,
					"MAT_DESC" 				=> $this->request->getPost("MAT_DESC"),
					"MAT_IP_CODE" 			=> $this->request->getPost("MAT_IP_CODE"),
					"Amount" 				=> $this->request->getPost("Amount"),
					"On_Insert" 			=> $startTime,
					"CURE_TIME" 			=> $cenvertedTime,
					"Count_Printed" 		=> $this->request->getPost("Count_Printed"),
					"Park" 					=> $slot,
				];
				$model->savePrint($data);

				$data["painting"] 			= $md1->orderBy("id", "DESC")->first();
				$id 						= $data["painting"]["id"];
				$slot 						= $data["painting"]["Park"];
				$data["park"] 				= $md2->where("slot", $slot)->first();
				$dtid 						= $data["park"]["id"];
				$dt 						= [
					"id_paint" 				=> $id,
				];
				
				$md2->update($dtid, $dt);
				return redirect()->to("print/" . $id);
			} 
			else {
				throw new \CodeIgniter\Database\Exceptions\DatabaseException();
			}
			
		}else{
            $model 						    = new Worker_model();
			$md2 							= new Park_B_Model();
			$md3 							= new Park_M_Model();
			
			$Park_A 						= $this->request->getPost("Park");
			$id_A 							= $this->request->getPost("id");
			$cenvertedTime 					= $this->request->getPost("CURE_TIME");
		
			$array_A 						= [
				"slot" 						=> $Park_A, 
				"id_paint" 					=> $id_A
			];
			
			$data_A["park"] 				= $md2->where($array_A)->first();
			// tampilkan 404 error jika data tidak ditemukan
			if (!$data_A["park"]) {
				throw new PageNotFoundException(
					"Park " . $Park_A . " Tidak di temukan / Sudah Kosong"
				);
			} else {
				$dtid_A 					= $data_A["park"]["id"];
				
				$dt_A 						= [
					"id_paint" 				=> "0",
				];

				$md2->update($dtid_A, $dt_A);
			}
			
			if (($dt_B["park"] = $md3->where("id_paint", "0")->first())) {
				$slot 						= $dt_B["park"]["slot"];
				$startTime 					= date("d/m/Y H.i");
				$WM_NAME_WM_SURNAME 		= $session->get("WM_NAME") . " " . $session->get("WM_SURNAME");
				$data_B						= [
					"WM_CODE" 				=> $session->get("WM_CODE"),
					"WM_GROUP" 				=> $session->get("GROUP"),
					"WM_SHIFT" 				=> $session->get("SHIFT"),
					"WM_NAME_WM_SURNAME" 	=> $WM_NAME_WM_SURNAME,
					"MCH" 					=> $this->request->getPost("mch1"),
					"MAT_IP_CODE" 			=> $this->request->getPost("MAT_IP_CODE"),
					"MAT_DESC" 				=> $this->request->getPost("MAT_DESC"),
					"Amount" 				=> $this->request->getPost("Amount"),
					"On_Insert" 			=> $startTime,
					"CURE_TIME" 			=> $cenvertedTime,
					"Count_Printed" 		=> $this->request->getPost("Count_Printed"),
					"Park" 					=> $slot,
					"M_id" 					=> $this->request->getPost("id"),
				];
				$model->savePrint($data_B);

				$data_B["painting"] 		= $md1->orderBy("id", "DESC")->first();
				$id_B 						= $data_B["painting"]["id"];
				$slot 						= $data_B["painting"]["Park"];
				$data_B["park"] 			= $md3->where("slot", $slot)->first();
				$dtid_B 					= $data_B["park"]["id"];
				$dt_B 						= [
					"id_paint" 				=> $id_B,
				];
				
				$md3->update($dtid_B, $dt_B);
				return redirect()->to("p_man/" . $id_B);
			} 
			else {
				throw new \CodeIgniter\Database\Exceptions\DatabaseException();
			}
		}
    }

    public function print()
    {
        $md1 = new KomikModel();
        $data["title"] = "Print Tag";
        $data["painting"] = $md1->orderBy("id", "DESC")->first();
            echo view("C_U/print", $data);
    }

    public function get_tag()
    {
        $md1 = new KomikModel();
        $list = $this->request->getPost("listTag");
        $id = explode(",", $list);
		$paint = $md1->where("id", $id[4])->first();
        if(strncmp($paint["MCH"], "A", 1) === 0){
            $md2 = new FIFO1Model();
        }
        if(strncmp($paint["MCH"], "M", 1) === 0){
            $md2 = new FIFO2Model();
        }
        if(strncmp($paint["MCH"], "B", 1) === 0){
            $md2 = new FIFO3Model();
        }
		
		$fifo = $md2->where("MAT_IP_CODE", $paint["MAT_IP_CODE"])->first();
        $data["painting"] = $paint;
        $data["fifo"] = $fifo;
        $data["title"] = "Tag Confirm";
        $data["message"] = "";
        echo view("C_U/ParkConf", $data);
    }

    public function tagconf()
    {
        $md1 = new KomikModel();
        $MCH = $this->request->getPost("MCH");
        if(strncmp($MCH, "A", 1) === 0){
            $md2 = new ParkModel();
        }
        if(strncmp($MCH, "M", 1) === 0){
            $md2 = new Park_M_Model();
        }
        $md3 = new MMModel();
        $md4 = new Park_BF_CURR_Model();
        $dateTime = date("d/m/Y H.i");

        $Park = $this->request->getPost("Park");
        $MM_CODE = $this->request->getPost("MM_CODE");
        $id = $this->request->getPost("id");
        $CURE_TIME = $this->request->getPost("CURE_TIME");
        $array = ["slot" => $Park, "id_paint" => $id];
        $data["park"] = $md2->where($array)->first();
        // tampilkan 404 error jika data tidak ditemukan
        if (!$data["park"]) {
            throw new PageNotFoundException(
                "Park " . $Park . " Tidak di temukan / Sudah Kosong"
            );
        } else {
            $dtid = $data["park"]["id"];
            $dtslot = $data["park"]["slot"];
            $dt1 = [
                "id_paint" => "0",
            ];
            $dt2 = [
                "MM_CODE" => $MM_CODE,
                "Park_id" => $dtslot,
                "Paint_id" => $id,
                "CURE_TIME" => $CURE_TIME,
                "dateTIME" => $dateTime,
            ];
            $dt3 = [
                "id_paint" => $id,
                "cured_stts" => "UNCURED",
                "dateTIME" => $dateTime,
            ];

            $md2->update($dtid, $dt1);
            $md3->insert($dt2);
            $md4->insert($dt3);

            return redirect()->to("parking");
        }
    }

    public function tagconf_manual()
    {
        $session = session();
        $md1 = new KomikModel();
        $T_Park = $this->request->getPost("T_Park");
        if($T_Park == "A"){
            $md2 = new ParkModel();
        }
        if($T_Park == "M"){
            $md2 = new Park_M_Model();
        }
        $md3 = new MMModel();
        $md4 = new CQModel();
        $md5 = new QModel();
        $md6 = new Park_BF_CURR_Model();
        $dateTime = date("d/m/Y H.i");
        $Qty_NIK = $session->get("QC_ID");
        $Park = $this->request->getPost("Park");
        $id = $this->request->getPost("id");
        $CURE_TIME = $this->request->getPost("CURE_TIME");
        $arr_park = ["slot" => $Park, "id_paint !=" => "0"];
        $arr_Qty = ["Qty_NIK" => $Qty_NIK];
        $data["park"] = $md2->where($arr_park)->first();
        $data["QC"] = $md4->getQC($Qty_NIK)->getRow();
        $dt = json_decode(json_encode($data["QC"]), true);
        // tampilkan 404 error jika data tidak ditemukan
        if (!$data["park"]) {
            throw new PageNotFoundException(
                "Park " . $Park . " Tidak di temukan / Sudah Kosong"
            );
        } else {
			$dtid = $data["park"]["id"];
			$dt1 = [
				"id_paint" => "0",
			];
			$dt2 = [
				"MM_CODE" => $Qty_NIK,
				"Park_id" => $dtid,
				"Paint_id" => $id,
				"CURE_TIME" => $CURE_TIME,
				"dateTIME" => $dateTime,
			];
			$dt3 = [
				"Qty_NIK" => $Qty_NIK,
				"MM_CODE" => "",
				"Park_id" => $dtid,
				"Paint_id" => $id,
				"CURE_TIME" => $CURE_TIME,
				"dateTIME" => $dateTime,
			];

			$md2->update($dtid, $dt1);
			$md3->insert($dt2);
			$md5->insert($dt3);

			return redirect()->to("park_view");
        }
    }

    public function tagconf_qty()
    {
        $md1 = new KomikModel();
        $MCH = $this->request->getPost("MCH");
        if(strncmp($MCH, "A", 1) === 0){
            $md2 = new ParkModel();
        }
        if(strncmp($MCH, "M", 1) === 0){
            $md2 = new Park_M_Model();
        }
        $md3 = new MMModel();
        $md4 = new CQModel();
        $md5 = new QModel();
        $md6 = new Park_BF_CURR_Model();
        $dateTime = date("d/m/Y H.i");
        
        $Qty_NIK = $this->request->getPost("Qty_NIK");
        $pass_QC = $this->request->getPost("pass_QC");
        $Park = $this->request->getPost("Park");
        $MM_CODE = $this->request->getPost("MM_CODE");
        $id = $this->request->getPost("id");
        $CURE_TIME = $this->request->getPost("CURE_TIME");
        $arr_park = ["slot" => $Park, "id_paint !=" => "0"];
        $arr_Qty = ["Qty_NIK" => $Qty_NIK];
        $data["park"] = $md2->where($arr_park)->first();
        $data["QC"] = $md4->getQC($Qty_NIK)->getRow();
        $dt = json_decode(json_encode($data["QC"]), true);
        // tampilkan 404 error jika data tidak ditemukan
        if (!$data["park"]) {
            throw new PageNotFoundException(
                "Park " . $Park . " Tidak di temukan / Sudah Kosong"
            );
        } else {
            if (!$data["QC"]) {
                throw new PageNotFoundException(
                    "User " . $Qty_NIK . "  QC Tidak Ditemukan"
                );
            } else {
				if (password_verify($pass_QC, $dt["pass"])) {
                    $dtid = $data["park"]["id"];
                    $dtslot = $data["park"]["slot"];
                    $dt1 = [
                        "id_paint" => "0",
                    ];
                    $dt2 = [
                        "MM_CODE" => $MM_CODE,
                        "Park_id" => $dtslot,
                        "Paint_id" => $id,
                        "CURE_TIME" => $CURE_TIME,
                        "dateTIME" => $dateTime,
                    ];
                    $dt3 = [
                        "Qty_NIK" => $Qty_NIK,
                        "MM_CODE" => $MM_CODE,
                        "Park_id" => $dtslot,
                        "Paint_id" => $id,
                        "CURE_TIME" => $CURE_TIME,
                        "dateTIME" => $dateTime,
                    ];
                    $dt4 = [
                        "id_paint" => $id,
                        "cured_stts" => "UNCURED",
                        "dateTIME" => $dateTime,
                    ];

                    $md2->update($dtid, $dt1);
                    $md3->insert($dt2);
                    $md5->insert($dt3);
                    $md6->insert($dt4);

                    return redirect()->to("parking");
				} else {
                    $data["painting"] = $md1->where("id", $id)->first();
                    $data["title"] = "Tag Confirm";
                    $data["message"] = '							    
										<div class="alert alert-danger" role="alert">
											<strong>Password Salah</strong>
										</div>
										';
                    echo view("C_U/ParkConf", $data);
				}
            }
        }
    }
}

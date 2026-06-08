<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\Worker_model;
use App\Models\KomikModel;
use App\Models\CustAgeIP;
use App\Models\CQModel;
use App\Models\Park_BF_CURR_Model;

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

        if ($pass != '') {
            $md4 = new CQModel();
            $data['QC'] = $md4->getQC($id)->getRow();
            $dt = json_decode(json_encode($data["QC"]), true);
            if ($dt && password_verify($pass, $dt["pass"])) {
                $ses_data = [
                    'MM_CODE'       => $id,
                    'MM_NAME'       => $dt['Full_Name'],
                    'logged_in_qc'  => '1'
                ];
                $session->set($ses_data);
                return redirect()->to('park_view');
            } else {
                session()->setFlashdata('pesan', 'Login Gagal: Password salah');
                return redirect()->to('parking');
            }
        } else {
            $model = new Worker_model();
            $data['park'] = $model->getWorker($id)->getRow();
            $dt = json_decode(json_encode($data['park']), true);
            if ($dt) {
                $ses_data = [
                    'MM_CODE'       => $dt['WM_CODE'],
                    'MM_NAME'       => $dt['WM_NAME'],
                    'MM_SURNAME'    => $dt['WM_SURNAME'],
                    'logged_in_mm'  => '1'
                ];
                $session->set($ses_data);
                return redirect()->to('park_view');
            } else {
                session()->setFlashdata('pesan', 'Login Gagal Nik : ' . $id . ' Tidak terdaftar');
                return redirect()->to('parking');
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
        try {
            $data["painting"] = $model->getWorker($id)->getRow();
        } catch (\RuntimeException $e) {
            $data["painting"] = null;
        }
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

    public function dev_set_session()
    {
        if (env('CI_ENVIRONMENT') !== 'development') {
            return $this->response->setStatusCode(403)->setBody('Forbidden');
        }
        $session = session();
        $session->set([
            "WM_CODE"       => $this->request->getPost("WM_CODE") ?: "TEST001",
            "GROUP"         => $this->request->getPost("GROUP") ?: "A",
            "SHIFT"         => $this->request->getPost("SHIFT") ?: "1",
            "WM_NAME"       => $this->request->getPost("WM_NAME") ?: "Test",
            "WM_SURNAME"    => $this->request->getPost("WM_SURNAME") ?: "User",
            "logged_in_wm"  => "1",
        ]);
        return $this->response->setJSON([
            "WM_CODE"   => $session->get("WM_CODE"),
            "GROUP"     => $session->get("GROUP"),
            "SHIFT"     => $session->get("SHIFT"),
            "WM_NAME"   => $session->get("WM_NAME"),
            "WM_SURNAME"=> $session->get("WM_SURNAME"),
        ]);
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

    public function print()
    {
        $md1 = new KomikModel();
        $data["title"] = "Print Tag";
        $data["painting"] = $md1->orderBy("id", "DESC")->first();
        echo view("C_U/print", $data);
    }
}

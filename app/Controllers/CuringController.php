<?php
namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\Worker_model;
use App\Models\KomikModel;
use App\Models\Park_BF_CURR_Model;

class CuringController extends BaseController
{
    public function cure_log()
    {
        $model = new Worker_model();
        $id = $this->request->getPost("WM_CODE");
        $group = $this->request->getPost("GROUP");
        $shift = $this->request->getPost("SHIFT");
        $data["painting"] = $model->getWorker($id)->getRow();
        $dt = json_decode(json_encode($data["painting"]), true);
        if ($dt) {
            $session = session();
            $ses_data = [
                "WM_CODE" => $dt["WM_CODE"],
                "GROUP" => $group,
                "SHIFT" => $shift,
                "WM_NAME" => $dt["WM_NAME"],
                "WM_SURNAME" => $dt["WM_SURNAME"],
                "logged_in_cm" => "1",
            ];
            $session->set($ses_data);
            $data["title"] = "Input Machine Code";
            echo view("C_U/cure_mch", $data);
        } else {
            session()->setFlashdata("pesan", "Login Gagal Nik : " . $id . " Tidak terdaftar");
            return redirect()->to("cure");
        }
    }

    public function get_cure_mch()
    {
        $md1 = new KomikModel();
        $TAG = $this->request->getPost("TAG");
        $id_TAG = explode(",", $TAG);

        $dt1 = $md1->where("id", $id_TAG[4])->first();

        $data = [
            "title" => "Tag CURE Confirm",
            "painting" => $dt1,
            "message" => "",
        ];
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

        $WM_NAME_WM_SURNAME = $session->get("WM_NAME") . " " . $session->get("WM_SURNAME");
        if (!$dt_cure_stts) {
            throw new PageNotFoundException("Park " . $MAT_CODE . " Tidak di temukan / Sudah CURED");
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

    public function logout_CURE()
    {
        session()->destroy();
        return redirect()->to("/cure");
    }
}

<?php
namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\Worker_model;
use App\Models\KomikModel;
use App\Models\Park_M_Model;
use App\Models\Park_B_Model;
use App\Models\MMModel;
use App\Models\CQModel;
use App\Models\QModel;
use App\Models\Park_BF_CURR_Model;
use App\Models\FIFO2Model;
use App\Models\FIFO3Model;

class ParkingController extends BaseController
{
    public function save()
    {
        $session = session();
        if (!$session->get("WM_CODE")) {
            return redirect()->to("worker")->with("error", "Silakan input NIK terlebih dahulu");
        }
        $md1 = new KomikModel();
        $mch = $this->request->getPost("mch");

        if (strncmp($mch, "M", 1) === 0) {
            return $this->_saveTypeM($session, $md1, $mch);
        } else {
            return $this->_saveTypeB($session, $md1, $mch);
        }
    }

    private function _saveTypeM($session, $md1, $mch)
    {
        if ($mch === "M3") {
            $md2 = new Park_B_Model();
        } else {
            $md2 = new Park_M_Model();
        }
        $model = new Worker_model();

        if (($dt["park"] = $md2->where("id_paint", "0")->first())) {
            $data = $this->_buildPaintData($session, $mch);
            $data["Park"] = $dt["park"]["slot"];
            $model->savePrint($data);
            $this->_updateParkingSlot($md1, $md2, $data);
            return redirect()->to("print/" . $data["painting_id"]);
        }
        throw new \CodeIgniter\Database\Exceptions\DatabaseException();
    }

    private function _saveTypeB($session, $md1, $mch)
    {
        $model = new Worker_model();
        $md2 = new Park_B_Model();
        $md3 = new Park_M_Model();

        $Park_A = $this->request->getPost("Park");
        $id_A = $this->request->getPost("id");
        $cenvertedTime = $this->request->getPost("CURE_TIME");

        $array_A = ["slot" => $Park_A, "id_paint" => $id_A];
        $data_A["park"] = $md2->where($array_A)->first();
        if (!$data_A["park"]) {
            throw new PageNotFoundException("Park " . $Park_A . " Tidak di temukan / Sudah Kosong");
        }
        $md2->update($data_A["park"]["id"], ["id_paint" => "0"]);

        if (($dt_B["park"] = $md3->where("id_paint", "0")->first())) {
            $data_B = [
                "WM_CODE" => $session->get("WM_CODE"),
                "WM_GROUP" => $session->get("GROUP"),
                "WM_SHIFT" => $session->get("SHIFT"),
                "WM_NAME_WM_SURNAME" => $session->get("WM_NAME") . " " . $session->get("WM_SURNAME"),
                "MCH" => $this->request->getPost("mch1"),
                "MAT_IP_CODE" => $this->request->getPost("MAT_IP_CODE"),
                "MAT_DESC" => $this->request->getPost("MAT_DESC"),
                "Amount" => $this->request->getPost("Amount"),
                "On_Insert" => date("d/m/Y H.i"),
                "CURE_TIME" => $cenvertedTime,
                "Count_Printed" => $this->request->getPost("Count_Printed"),
                "Park" => $dt_B["park"]["slot"],
                "M_id" => $this->request->getPost("id"),
            ];
            $model->savePrint($data_B);

            $data_B["painting"] = $md1->orderBy("id", "DESC")->first();
            $id_B = $data_B["painting"]["id"];
            $slot = $data_B["painting"]["Park"];
            $data_B["park"] = $md3->where("slot", $slot)->first();
            $md3->update($data_B["park"]["id"], ["id_paint" => $id_B]);
            return redirect()->to("p_man/" . $id_B);
        }
        throw new \CodeIgniter\Database\Exceptions\DatabaseException();
    }

    private function _buildPaintData($session, $mch)
    {
        $startTime = date("d/m/Y H.i");
        $agTime = $this->request->getPost("AG_time");

        if ($agTime == '0') {
            $cenvertedTime = date("d/m/Y H.i", strtotime("+2 hours"));
        } else {
            $timepicker = explode(":", $agTime);
            $cenvertedTime = date("d/m/Y H.i", strtotime("+" . $timepicker[0] . " hours +" . $timepicker[1] . " minutes"));
        }

        $data = [
            "WM_CODE" => session()->get("WM_CODE"),
            "WM_GROUP" => session()->get("GROUP"),
            "WM_SHIFT" => session()->get("SHIFT"),
            "WM_NAME_WM_SURNAME" => session()->get("WM_NAME") . " " . session()->get("WM_SURNAME"),
            "MCH" => $this->request->getPost("mch1") ?? $mch,
            "MAT_DESC" => $this->request->getPost("MAT_DESC"),
            "MAT_IP_CODE" => $this->request->getPost("MAT_IP_CODE"),
            "Amount" => $this->request->getPost("Amount"),
            "On_Insert" => $startTime,
            "CURE_TIME" => $cenvertedTime,
            "Count_Printed" => $this->request->getPost("Count_Printed"),
        ];

        return $data;
    }

    private function _updateParkingSlot($md1, $md2, &$data)
    {
        $painting = $md1->orderBy("id", "DESC")->first();
        $id = $painting["id"];
        $slot = $painting["Park"];
        $park = $md2->where("slot", $slot)->first();
        $md2->update($park["id"], ["id_paint" => $id]);
        $data["painting_id"] = $id;
    }

    public function get_tag()
    {
        $md1 = new KomikModel();
        $list = $this->request->getPost("listTag");
        $id = explode(",", $list);
        $paint = $md1->where("id", $id[4])->first();

        if (strncmp($paint["MCH"], "M", 1) === 0) {
            $md2 = new FIFO2Model();
        } else {
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
        $md2 = new Park_M_Model();
        $md3 = new MMModel();
        $md4 = new Park_BF_CURR_Model();
        $dateTime = date("d/m/Y H.i");

        $Park = $this->request->getPost("Park");
        $MM_CODE = $this->request->getPost("MM_CODE");
        $id = $this->request->getPost("id");
        $CURE_TIME = $this->request->getPost("CURE_TIME");
        $array = ["slot" => $Park, "id_paint" => $id];
        $data["park"] = $md2->where($array)->first();

        if (!$data["park"]) {
            throw new PageNotFoundException("Park " . $Park . " Tidak di temukan / Sudah Kosong");
        }

        $dtid = $data["park"]["id"];
        $dtslot = $data["park"]["slot"];
        $md2->update($dtid, ["id_paint" => "0"]);
        $md3->insert([
            "MM_CODE" => $MM_CODE,
            "Park_id" => $dtslot,
            "Paint_id" => $id,
            "CURE_TIME" => $CURE_TIME,
            "dateTIME" => $dateTime,
        ]);
        $md4->insert([
            "id_paint" => $id,
            "cured_stts" => "UNCURED",
            "dateTIME" => $dateTime,
        ]);

        return redirect()->to("parking");
    }

    public function tagconf_manual()
    {
        $session = session();
        $md2 = new Park_M_Model();
        $md3 = new MMModel();
        $md5 = new QModel();
        $md6 = new Park_BF_CURR_Model();
        $dateTime = date("d/m/Y H.i");
        $Qty_NIK = $session->get("QC_ID");
        $Park = $this->request->getPost("Park");
        $id = $this->request->getPost("id");
        $CURE_TIME = $this->request->getPost("CURE_TIME");
        $arr_park = ["slot" => $Park, "id_paint !=" => "0"];
        $data["park"] = $md2->where($arr_park)->first();

        if (!$data["park"]) {
            throw new PageNotFoundException("Park " . $Park . " Tidak di temukan / Sudah Kosong");
        }

        $dtid = $data["park"]["id"];
        $md2->update($dtid, ["id_paint" => "0"]);
        $md3->insert([
            "MM_CODE" => $Qty_NIK,
            "Park_id" => $dtid,
            "Paint_id" => $id,
            "CURE_TIME" => $CURE_TIME,
            "dateTIME" => $dateTime,
        ]);
        $md5->insert([
            "Qty_NIK" => $Qty_NIK,
            "MM_CODE" => "",
            "Park_id" => $dtid,
            "Paint_id" => $id,
            "CURE_TIME" => $CURE_TIME,
            "dateTIME" => $dateTime,
        ]);

        return redirect()->to("park_view");
    }

    public function tagconf_qty()
    {
        $md1 = new KomikModel();
        $md2 = new Park_M_Model();
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
        $data["park"] = $md2->where($arr_park)->first();
        $data["QC"] = $md4->getQC($Qty_NIK)->getRow();
        $dt = json_decode(json_encode($data["QC"]), true);

        if (!$data["park"]) {
            throw new PageNotFoundException("Park " . $Park . " Tidak di temukan / Sudah Kosong");
        }
        if (!$data["QC"]) {
            throw new PageNotFoundException("User " . $Qty_NIK . "  QC Tidak Ditemukan");
        }

        if (!password_verify($pass_QC, $dt["pass"])) {
            $data["painting"] = $md1->where("id", $id)->first();
            $data["title"] = "Tag Confirm";
            $data["message"] = '<div class="alert alert-danger" role="alert"><strong>Password Salah</strong></div>';
            echo view("C_U/ParkConf", $data);
            return;
        }

        $dtid = $data["park"]["id"];
        $dtslot = $data["park"]["slot"];
        $md2->update($dtid, ["id_paint" => "0"]);
        $md3->insert([
            "MM_CODE" => $MM_CODE,
            "Park_id" => $dtslot,
            "Paint_id" => $id,
            "CURE_TIME" => $CURE_TIME,
            "dateTIME" => $dateTime,
        ]);
        $md5->insert([
            "Qty_NIK" => $Qty_NIK,
            "MM_CODE" => $MM_CODE,
            "Park_id" => $dtslot,
            "Paint_id" => $id,
            "CURE_TIME" => $CURE_TIME,
            "dateTIME" => $dateTime,
        ]);
        $md6->insert([
            "id_paint" => $id,
            "cured_stts" => "UNCURED",
            "dateTIME" => $dateTime,
        ]);

        return redirect()->to("parking");
    }
}

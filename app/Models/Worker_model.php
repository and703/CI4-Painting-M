<?php namespace App\Models;
use CodeIgniter\Model;

class Worker_model extends Model
{
    private $db1;

    private $pcs;

    public function __construct()
    {
        $this->db1 = db_connect(); // default database group

        $this->pcs = db_connect("pcs"); // other database group
    }

    public function getWorker($id = false)
    {
        $builder = $this->pcs->table("MD_WORKERS");
        if ($id === false) {
            return $builder->get();
        } else {
            return $builder->getWhere(["WM_CODE" => $id]);
        }
    }

    public function getGtip($id = false)
    {
        $builder = $this->pcs->table("MD_MATERIALS");
        if ($id === false) {
            return $builder->get();
        } else {
            return $builder->getWhere(["MAT_IP_CODE" => $id]);
        }
    }

    public function getMch($mch,$side,$ip)
    {
        $query = $this->pcs->query("SELECT
                                        DISTINCT de.MCH_CODE, mmc.MCH_DESC, 
                                        mm.MAT_CODE, de.EVS_MCH_SIDE 
                                    FROM PCS.dbo.DC_EVENTS de, 
                                            PCS.dbo.MD_MATERIALS mm, 
                                            PCS.dbo.MD_MACHINES mmc
                                    WHERE CONVERT(VARCHAR(10),de.EVS_START,101) = CONVERT(VARCHAR(10),GETDATE(),101)
                                        AND de.MAT_SAP_CODE = mm.MAT_SAP_CODE 
                                        AND de.MCH_CODE = mmc.MCH_CODE
                                        AND mmc.PP_CODE = 'V01'
                                        AND de.MCH_CODE = '".$mch."'
                                        AND de.EVS_MCH_SIDE = '".$side."'
                                        AND mm.MAT_CODE = '".$ip."'");
        return $query->getResultArray();
    }

    public function savePrint($data)
    {
        $query = $this->db1->table("painting")->insert($data);
        return $query;
    }

    public function viewPrint()
    {
        $builder = $this->db1->table("painting");
        $builder->orderBy("id", "DESC");
        $builder->limit(1);
        return $builder->get();
    }
	
	public function apiJumlah(){
		$date = date('Y-m-d');
		
		//$date = date('Y-m-d', strtotime('-1 Days', date('Y-m-d');
		$sql = "select sum(Amount) as Jumlah from painting_format where On_Insert >= '2022-07-18 00:00:00.00' and On_Insert <= '2022-07-18 23:59:59.00' order by On_Insert DESC";
		
		// $row
		
		
		
		return $this->db1->query($sql)->getResultArray()[0];
		//return $datel
	}
	
	public function getDataPaint()
    {
        $row = [];
        $date = date('Y-m-d');

        $sql = "select sum(Amount) as jumlah from painting_format";
        $shift1 = $this->db1->query($sql." where On_Insert >= '".$date." 00:00:00.00' and On_Insert <= '".$date." 07:59:59.00' order by On_Insert DESC")->getResultArray()[0];

        if ($shift1['jumlah'] == null) {
            $row['shift1'] = 0;
        } else {
            $row['shift1'] = $shift1['jumlah'];
        }


        $shift2 = $this->db1->query($sql." where On_Insert >= '".$date." 08:00:00.00' and On_Insert <= '".$date." 15:59:59.00' order by On_Insert DESC")->getResultArray()[0];

        if ($shift2['jumlah'] == null) {
            $row['shift2'] = 0;
        } else {
            $row['shift2'] = $shift2['jumlah'];
        }



        $shift3 = $this->db1->query($sql." where On_Insert >= '".$date." 16:00:00.00' and On_Insert <= '".$date." 23:59:59.00' order by On_Insert DESC")->getResultArray()[0];

        if ($shift3['jumlah'] == null) {
            $row['shift3'] = 0;
        } else {
            $row['shift3'] = $shift3['jumlah'];
        }

        return $row;
    }

    public function getDataPaintYesterday()
    {
        $row = [];
        $date = date('Y-m-d', strtotime('-1 Days', strtotime(date('Y-m-d'))));

        $sql = "select sum(Amount) as jumlah from painting_format";
        $shift1 = $this->db1->query($sql." where On_Insert >= '".$date." 00:00:00.00' and On_Insert <= '".$date." 07:59:59.00' order by On_Insert DESC")->getResultArray()[0];

        if ($shift1['jumlah'] == null) {
            $row['shift1'] = 0;
        } else {
            $row['shift1'] = $shift1['jumlah'];
        }


        $shift2 = $this->db1->query($sql." where On_Insert >= '".$date." 08:00:00.00' and On_Insert <= '".$date." 15:59:59.00' order by On_Insert DESC")->getResultArray()[0];

        if ($shift2['jumlah'] == null) {
            $row['shift2'] = 0;
        } else {
            $row['shift2'] = $shift2['jumlah'];
        }



        $shift3 = $this->db1->query($sql." where On_Insert >= '".$date." 16:00:00.00' and On_Insert <= '".$date." 23:59:59.00' order by On_Insert DESC")->getResultArray()[0];

        if ($shift3['jumlah'] == null) {
            $row['shift3'] = 0;
        } else {
            $row['shift3'] = $shift3['jumlah'];
        }

        return $row;
    }

    public function getDataPaintAfterYesterday()
    {
        $row = [];
        $date = date('Y-m-d', strtotime('-2 Days', strtotime(date('Y-m-d'))));

        $sql = "select sum(Amount) as jumlah from painting_format";
        $shift1 = $this->db1->query($sql." where On_Insert >= '".$date." 00:00:00.00' and On_Insert <= '".$date." 07:59:59.00' order by On_Insert DESC")->getResultArray()[0];
		
		

        if ($shift1['jumlah'] == null) {
            $row['shift1'] = 0;
        } else {
            $row['shift1'] = $shift1['jumlah'];
        }


        $shift2 = $this->db1->query($sql." where On_Insert >= '".$date." 08:00:00.00' and On_Insert <= '".$date." 15:59:59.00' order by On_Insert DESC")->getResultArray()[0];

        if ($shift2['jumlah'] == null) {
            $row['shift2'] = 0;
        } else {
            $row['shift2'] = $shift2['jumlah'];
        }



        $shift3 = $this->db1->query($sql." where On_Insert >= '".$date." 16:00:00.00' and On_Insert <= '".$date." 23:59:59.00' order by On_Insert DESC")->getResultArray()[0];

        if ($shift3['jumlah'] == null) {
            $row['shift3'] = 0;
        } else {
            $row['shift3'] = $shift3['jumlah'];
        }

        return $row;
    }


    public function ajaxPaint()
    {
        $today = $this->getDataPaint();
        $yesterday = $this->getDataPaintYesterday();
        $afteryesterday = $this->getDataPaintAfterYesterday();


        $row = [];

        $row['diff'] = [];


        $row['diff']['difftoday1'] = $today['shift1'] - $yesterday['shift3'];
        $row['diff']['difftoday2'] = $today['shift2'] - $today['shift1'];
        $row['diff']['difftoday3'] = $today['shift3'] - $today['shift2'];

        $row['diff']['diffyesterday1'] = $yesterday['shift1'] - $afteryesterday['shift3'];
        $row['diff']['diffyesterday2'] = $yesterday['shift2'] - $yesterday['shift1'];
        $row['diff']['diffyesterday3'] = $yesterday['shift3'] - $yesterday['shift2'];

        $row['actual']['today']['shift1'] = $today['shift1'];
        $row['actual']['today']['shift2'] = $today['shift2'];
        $row['actual']['today']['shift3'] = $today['shift3'];

        $row['actual']['yesterday']['shift1'] = $yesterday['shift1'];
        $row['actual']['yesterday']['shift2'] = $yesterday['shift2'];
        $row['actual']['yesterday']['shift3'] = $yesterday['shift3'];

        $row['actual']['afteryesterday']['shift1'] = $afteryesterday['shift1'];
        $row['actual']['afteryesterday']['shift2'] = $afteryesterday['shift2'];
        $row['actual']['afteryesterday']['shift3'] = $afteryesterday['shift3'];



        $row['total']['actual']['today'] = $today['shift1'] + $today['shift2'] + $today['shift3'];
        $row['total']['actual']['yesterday'] = $yesterday['shift1'] + $yesterday['shift2'] + $yesterday['shift3'];
        $row['total']['actual']['afteryesterday'] = $afteryesterday['shift1'] + $afteryesterday['shift2'] + $afteryesterday['shift3'];

        $row['total']['diff']['today'] = ($today['shift1'] + $today['shift2'] + $today['shift3']) - ($yesterday['shift1'] + $yesterday['shift2'] + $yesterday['shift3']);
        $row['total']['diff']['yesterday'] = ($yesterday['shift1'] + $yesterday['shift2'] + $yesterday['shift3']) - ($afteryesterday['shift1'] + $afteryesterday['shift2'] + $afteryesterday['shift3']);

        return $row;
    }
	
}

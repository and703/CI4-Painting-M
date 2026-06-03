<?php

namespace App\Models; // Marking untuk model

use CodeIgniter\Model;

class M_Chart extends Model
{
    //table = deklarasikan nama tabel yg akan dipanggil
    protected $painting = "painting";
    protected $parking = "parking";
    
    
    //inconstruct
    protected $request; 
    protected $db;
    protected $db_paint;// deklarasi tabel report_movingman/ penamaan fungsi
    protected $db_park;
   
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $request = \Config\Services::request();
        $this->request = $request;
        //deklartabel
        $this->db_paint = $this->db->table($this->painting);
        $this->db_park = $this->db->table($this->parking);
    }
}
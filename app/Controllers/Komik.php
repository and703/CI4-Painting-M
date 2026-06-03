<?php

namespace App\Controllers;

use App\Models\KomikModel;
use App\Models\CustAgeIP;

class Komik extends BaseController
{
    protected $komikModel;
    protected $custAgeIP;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
        $this->custAgeIP = new CustAgeIP();
    }

    public function index()
    {
        // $komik = $this->komikModel->findAll();

        $data = [
            "title" => "Daftar Tag",
            "komik" => $this->komikModel->getKomik(),
        ];

        // $komikModel = new \App\Models\KomikModel();

        return view("komik/index", $data);
    }

    public function detail($slug)
    {
        $data = [
            "title" => "Detail Tag",
            "komik" => $this->komikModel->getKomik($slug),
        ];

        //jika komik tidak ada di tabel
        if (empty($data["komik"])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                "Judul komik" . $slug . "Tidak di temukan"
            );
        }
        return view("komik/detail", $data);
    }

    public function detail2($slug)
    {
		$dtGT = $this->komikModel->getKomik($slug);
        $data = [
            "title" => "Detail Tag",
            "komik" => $dtGT,
        ];
        
        //jika komik tidak ada di tabel
        if (empty($data["komik"])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                "Judul komik" . $slug . "Tidak di temukan"
            );
        }
        return view("komik/detail2", $data);
		//print_r($data);
    }

    public function detail3($slug)
    {
        $data = [
            "title" => "Detail Tag",
            "komik" => $this->komikModel->getKomik($slug),
        ];

        //jika komik tidak ada di tabel
        if (empty($data["komik"])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                "Judul komik" . $slug . "Tidak di temukan"
            );
        }
        return view("komik/detail3", $data);
    }

    public function reboaiaca($slug)
    {
        $data["title"]   = "Detail Tag";
        $data["komik"]  = $this->komikModel->getKomik($slug);
        //jika komik tidak ada di tabel
        if (empty($data["komik"])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                "Judul komik" . $slug . "Tidak di temukan"
            );
        }
        return view("komik/reboiaca", $data);
    }

    public function parkDet($id)
    {
        $data = [
            "title" => "Detail Tag",
            "park" => $this->ParkModel->getPark($id),
        ];

        //jika komik tidak ada di tabel
        if (empty($data["komik"])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                "Judul komik" . $slug . "Tidak di temukan"
            );
        }
        //return view('komik/detail', $data);
        print_r($data);
    }

    public function create()
    {
        $data = [
            "title" => "Form Tambah Data Tag",
            "validation" => \Config\Services::validation(),
        ];
        return view("komik/create", $data);
    }

    public function save()
    {
        // validasi input
        if (
            !$this->validate([
                "judul" => [
                    "rules" => "required|is_unique[komik.judul]",
                    "errors" => [
                        "required" => "{field} komik harus di isi",
                        "is_unique" => "{field} komik tidak boleh sama",
                    ],
                ],
                "sampul" => [
                    "rules" =>
                        "max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]",
                    "errors" => [
                        "max_size" => "Ukuran gambar Terlalu Besar",
                        "is_image" => "yang anda pilih bukan gambar",
                        "mime_in" => "yang anda pilih bukan gambar",
                    ],
                ],
            ])
        ) {
            // $validation = \Config\Services::validation();

            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()
                ->to("/komik/create")
                ->withInput();
        }

        //ambil gambar
        $fileSampul = $this->request->getFile("sampul");
        //cek apakah tidak ada gambar yang di upload
        if ($fileSampul->getError() == 4) {
            $namaSampul = "default.png";
        } else {
            // Generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move("img", $namaSampul);
        }

        $slug = url_title($this->request->getVar("judul"), "-", true);
        $this->komikModel->save([
            "judul" => $this->request->getVar("judul"),
            "slug" => $slug,
            "penulis" => $this->request->getVar("penulis"),
            "penerbit" => $this->request->getVar("penerbit"),
            "sampul" => $namaSampul,
        ]);

        session()->setFlashdata("pesan", "Data Berhasil di Tambahkan.");

        return redirect()->to("/komik");
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $komik = $this->komikModel->find($id);

        // cek jika file gambarnya default.jpg
        if ($komik["sampul"] != "default.png") {
            // hapus gambar
            unlink("img/" . $komik["sampul"]);
        }

        $this->komikModel->delete($id);
        session()->setFlashdata("pesan", "Data Berhasil di Hapus.");
        return redirect()->to("/komik");
    }

    public function edit($slug)
    {
        $data = [
            "title" => "Form Ubah Data Komik",
            "validation" => \Config\Services::validation(),
            "komik" => $this->komikModel->getKomik($slug),
        ];
        return view("komik/edit", $data);
    }

    public function update($id)
    {
        $data = [
            "Count_Printed" => $this->request->getVar("Count_Printed"),
        ];
        $this->komikModel->update($id, $data);

        session()->setFlashdata("pesan", "RePrint Success. ");

        return redirect()->to("/komik");
    }

    public function update2($id)
    {
        $session = session();
        if(strncmp($this->request->getVar("mch"), "A", 1) === 0){
            $data = [
                "Count_Printed" => $this->request->getVar("Count_Printed"),
            ];
            $this->komikModel->update($id, $data);
    
            session()->setFlashdata("pesan", "Print Success. ");
    
            return redirect()->to("worker");

        }else{
            $data = [
                "Count_Printed" => $this->request->getVar("Count_Printed"),
            ];
            $this->komikModel->update($id, $data);
    
            session()->setFlashdata("pesan", "Print Success. ");
    
            $session->destroy();
            return redirect()->to("worker");
        }
    }

    public function get($id)
    {
        $data = [
            "Count_Printed" => $this->request->getVar("Count_Printed"),
        ];
        $this->komikModel->update($id, $data);

        session()->setFlashdata("pesan", "RePrint Success. ");

        return redirect()->to("/parking");
    }
}

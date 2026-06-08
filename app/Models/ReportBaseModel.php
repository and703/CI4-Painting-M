<?php
namespace App\Models;

use CodeIgniter\Model;

class ReportBaseModel extends Model
{
    protected $request;
    protected $db;
    protected $tableBuilder;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
        if (isset($this->tableName)) {
            $this->tableBuilder = $this->db->table($this->tableName);
        }
    }

    public function get_data()
    {
        $this->_get_datatables();
        if ($this->request->getPost("length") != -1) {
            $this->tableBuilder->limit(
                $this->request->getPost("length"),
                $this->request->getPost("start")
            );
        }
        $query = $this->tableBuilder->get();
        return $query->getResult();
    }

    public function _get_datatables()
    {
        $this->_applyFilters();
        $this->_applySearch();
        $this->_applyOrder();
    }

    protected function _applyFilters()
    {
    }

    protected function _applySearch()
    {
        $column_search = $this->column_search ?? [];
        $searchValue = $this->request->getPost('search')['value'] ?? '';

        if ($searchValue) {
            $i = 0;
            foreach ($column_search as $item) {
                if ($i === 0) {
                    $this->tableBuilder->groupStart();
                    $this->tableBuilder->like($item, $searchValue);
                } else {
                    $this->tableBuilder->orLike($item, $searchValue);
                }
                if (count($column_search) - 1 == $i) {
                    $this->tableBuilder->groupEnd();
                }
                $i++;
            }
        }
    }

    protected function _applyOrder()
    {
        $column_order = $this->column_order ?? [];
        $post_order = $this->request->getPost('order');
        if (isset($post_order)) {
            $this->tableBuilder->orderBy(
                $column_order[$post_order['0']['column']],
                $post_order['0']['dir']
            );
        } elseif (isset($this->defaultOrder)) {
            $this->tableBuilder->orderBy(key($this->defaultOrder), $this->defaultOrder[key($this->defaultOrder)]);
        }
    }

    public function count_filtered()
    {
        $this->_get_datatables();
        return $this->tableBuilder->countAllResults();
    }

    public function count_all()
    {
        return $this->db->table($this->tableName)->countAllResults();
    }

    protected function rangeindo($tgl, $ambil)
    {
        $tglORI = explode(" - ", $tgl);
        $tglAwal = explode("/", $tglORI[$ambil]);
        return $tglAwal[0] . "/" . $tglAwal[1] . "/" . $tglAwal[2];
    }

    protected function rangeDb($tgl, $ambil)
    {
        $tglORI = explode(" - ", $tgl);
        $tglAwal = explode("/", $tglORI[$ambil]);
        return $tglAwal[2] . "-" . $tglAwal[1] . "-" . $tglAwal[0];
    }
}

<?php
namespace App\Models;

class M_Report_paint extends ReportBaseModel
{
    protected $tableName = "v_tbl_allprint_status";
    protected $column_order = ['', 'MCH', 'IP_CODE', '', 'AMOUNT', 'SLOT', 'PRINT_OUT', '', '', 'GT_STATUS', '', '', '', ''];
    protected $column_search = ['IP_CODE', 'SLOT'];

    protected function _applyFilters()
    {
        $f1 = $this->request->getPost("f1");
        if ($f1) {
            $tgl1 = $this->rangeDb($f1, 0);
            $tgl2 = $this->rangeDb($f1, 1);
            $this->tableBuilder->where("CAST(PRINT_OUT AS DATE)>=", $tgl1);
            $this->tableBuilder->where("CAST(PRINT_OUT AS DATE)<=", $tgl2);
        }

        $f2 = $this->request->getPost("f2");
        if ($f2) {
            $shifts = [
                1 => ['00:00', '08:00'],
                2 => ['08:00', '16:00'],
                3 => ['16:00', '23:59'],
            ];
            if (isset($shifts[$f2])) {
                $this->tableBuilder->where(
                    "CAST(PRINT_OUT AS TIME) BETWEEN ? AND ?",
                    [$shifts[$f2][0], $shifts[$f2][1]]
                );
            }
        }
    }
}

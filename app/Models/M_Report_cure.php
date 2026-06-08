<?php
namespace App\Models;

class M_Report_cure extends ReportBaseModel
{
    protected $tableName = "bf_cure";
    protected $column_order = ['MM_CODE', 'MAT_IP_CODE', 'MAT_DESC', 'Amount', 'Park', 'CURE_TIME', 'cured_stts', 'actual_cure'];
    protected $column_search = ['MAT_IP_CODE', 'Amount'];

    protected function _applyFilters()
    {
        $f1 = $this->request->getPost("f1");
        if ($f1) {
            $tgl1 = $this->rangeDb($f1, 0);
            $tgl2 = $this->rangeDb($f1, 1);
            $this->tableBuilder->where("CAST(CURE_TIME AS DATE)>=", $tgl1);
            $this->tableBuilder->where("CAST(CURE_TIME AS DATE)<=", $tgl2);
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
                    "CAST(CURE_TIME AS TIME) BETWEEN ? AND ?",
                    [$shifts[$f2][0], $shifts[$f2][1]]
                );
            }
        }
    }
}

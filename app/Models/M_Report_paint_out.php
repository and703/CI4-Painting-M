<?php
namespace App\Models;

class M_Report_paint_out extends ReportBaseModel
{
    protected $tableName = "v_tbl_checkout_1";
    protected $column_order = ['IP_CODE', 'MAT_DESC', 'MCH', 'AMOUNT', 'SLOT', 'USERNAME', 'GROUP_PAINT', 'SHIFT', 'PRINT_OUT', 'HOURS', 'EXPIRED_TIME', 'CURE_TIME', 'CHECKOUT_TIME'];
    protected $column_search = ['IP_CODE', 'SLOT'];

    protected function _applyFilters()
    {
        $f1 = $this->request->getPost("f1");
        if ($f1) {
            $tgl1 = $this->rangeDb($f1, 0);
            $tgl2 = $this->rangeDb($f1, 1);
            $this->tableBuilder->where("CAST(CHECKOUT_TIME AS DATE)>=", $tgl1);
            $this->tableBuilder->where("CAST(CHECKOUT_TIME AS DATE)<=", $tgl2);
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
                    "CAST(CHECKOUT_TIME AS TIME) BETWEEN ? AND ?",
                    [$shifts[$f2][0], $shifts[$f2][1]]
                );
            }
        }
    }
}

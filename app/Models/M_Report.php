<?php
namespace App\Models;

class M_Report extends ReportBaseModel
{
    protected $tableName = "report_movingman";
    protected $column_order = ['', '', 'IP_CODE', '', 'Parked', 'Amount', 'CheckOut'];
    protected $column_search = ['IP_CODE', 'Parked'];
    protected $defaultOrder = ['id' => 'desc'];

    protected function _applyFilters()
    {
        $f1 = $this->request->getPost("f1");
        if ($f1) {
            $tgl1 = $this->rangeindo($f1, 0);
            $tgl2 = $this->rangeindo($f1, 1);
            $this->tableBuilder->where("SUBSTR(CheckOut,1,10)>=", $tgl1);
            $this->tableBuilder->where("SUBSTR(CheckOut,1,10)<=", $tgl2);
        }

        $f2 = $this->request->getPost("f2");
        if ($f2) {
            $shifts = [
                1 => ['00.00', '07.59'],
                2 => ['08.00', '15.59'],
                3 => ['16.00', '23.59'],
            ];
            if (isset($shifts[$f2])) {
                $this->tableBuilder->where("SUBSTR(CheckOut,12,12)>=", $shifts[$f2][0]);
                $this->tableBuilder->where("SUBSTR(CheckOut,12,12)<=", $shifts[$f2][1]);
            }
        }
    }
}

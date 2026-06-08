<?php
namespace App\Models;

class M_Report_parking extends ReportBaseModel
{
    protected $tableName = "v_parking_filled";
    protected $column_order = ['', 'MAT_IP_CODE', '', 'slot', 'Amount', 'On_Insert', 'CURE_TIME'];
    protected $column_search = ['MAT_IP_CODE', 'slot'];
    protected $defaultOrder = ['id' => 'desc'];
}

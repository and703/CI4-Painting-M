<?php
namespace App\Models;

use CodeIgniter\Model;

class ParkingSlotModel extends Model
{
    protected $DBGroup = "default";

    private $tables = [
        'A' => 'parking',
        'M' => 'parking_m',
        'B' => 'parking_b',
    ];

    private $fifoTables = [
        'A' => 'fifo_park',
        'M' => 'fifo_park_m',
        'B' => 'fifo_park_b',
    ];

    public function getSlots($type)
    {
        $table = $this->tables[$type] ?? 'parking';
        $db = \Config\Database::connect();
        return $db->table($table)->orderBy('id', 'ASC')->get()->getResultArray();
    }

    public function getPaintingWithStatus($paintingId)
    {
        $db = \Config\Database::connect();
        $painting = $db->table('painting')->where('id', $paintingId)->get()->getRowArray();
        if (!$painting) {
            return null;
        }

        $cureTime = $painting['CURE_TIME'] ?? '';
        $onInsert = $painting['On_Insert'] ?? '';

        $dateCureObj = date_create_from_format('d/m/Y H.i', $cureTime);
        $datePrintObj = date_create_from_format('d/m/Y H.i', $onInsert);

        if (!$dateCureObj || !$datePrintObj) {
            return null;
        }

        $dateCure = $dateCureObj->format('Y-m-d H:i');
        $timeCure = $dateCureObj->format('H:i');
        $dateprint = $datePrintObj->format('Y-m-d H:i');
        $dateNow = date_create()->format('Y-m-d H:i');
        $dateExp = date('Y-m-d H:i', strtotime('+120 hours ' . $dateprint));

        $status = 'ready';
        if (strtotime($dateNow) <= strtotime($dateCure)) {
            $status = 'curing';
        } elseif (strtotime($dateNow) >= strtotime($dateExp)) {
            $status = 'expired';
        }

        return array_merge($painting, [
            'timeCure' => $timeCure,
            'dateCure' => $dateCure,
            'dateExp' => $dateExp,
            'status' => $status,
        ]);
    }

    public function getFifoSlots($type, $ipCode)
    {
        $table = $this->fifoTables[$type] ?? 'fifo_park';
        $db = \Config\Database::connect();
        return $db->table("$table fp")
            ->select("row_number() over (order by fp.id) as No, fp.*")
            ->where('fp.MAT_IP_CODE', $ipCode)
            ->get()
            ->getResultArray();
    }

    public function getBuffStockSlots()
    {
        $db = \Config\Database::connect();
        return $db->table('buff_stock_bytime')
            ->where('STATUS', 'YES')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function checkIpCode($ipCode)
    {
        $db = \Config\Database::connect();
        return $db->table('ip_outside')
            ->where('IP_CODE', $ipCode)
            ->where('is_active', '1')
            ->get()
            ->getRowArray();
    }

    public function checkPaintingId($id)
    {
        $db = \Config\Database::connect();
        return $db->table('painting')
            ->where('id', $id)
            ->get()
            ->getRowArray();
    }
}

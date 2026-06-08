<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaintingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'WM_CODE' => ['type' => 'INT', 'constraint' => 8, 'default' => 0],
            'WM_NAME_WM_SURNAME' => ['type' => 'TEXT', 'null' => true],
            'MCH' => ['type' => 'TEXT'],
            'MAT_IP_CODE' => ['type' => 'INT', 'constraint' => 8, 'default' => 0],
            'MAT_DESC' => ['type' => 'TEXT', 'null' => true],
            'Amount' => ['type' => 'INT', 'constraint' => 2, 'null' => true],
            'On_Insert' => ['type' => 'TEXT'],
            'CURE_TIME' => ['type' => 'TEXT'],
            'Count_Printed' => ['type' => 'INT', 'null' => true],
            'Park' => ['type' => 'TEXT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('painting');
    }

    public function down()
    {
        $this->forge->dropTable('painting');
    }
}

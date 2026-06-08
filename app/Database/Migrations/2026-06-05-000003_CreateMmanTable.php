<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMmanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'MM_CODE' => ['type' => 'INT', 'constraint' => 11],
            'Paint_id' => ['type' => 'INT', 'constraint' => 11],
            'Park_id' => ['type' => 'INT', 'constraint' => 11],
            'CURE_TIME' => ['type' => 'TEXT'],
            'dateTIME' => ['type' => 'TEXT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mman');
    }

    public function down()
    {
        $this->forge->dropTable('mman');
    }
}

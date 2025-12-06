<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateParticipantsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'meeting_id'  => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'name'        => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'barcode_id'  => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
                'unique'     => true,
            ],
            'status'      => [
                'type'       => 'ENUM',
                'constraint' => ['hadir', 'belum_hadir'],
                'default'    => 'belum_hadir',
            ],
            'scanned_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'created_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('meeting_id', 'meetings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('participants');
    }

    public function down()
    {
        $this->forge->dropTable('participants');
    }
}

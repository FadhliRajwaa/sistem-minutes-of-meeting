<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAttendanceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'attendance_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'meeting_id' => [
                'type' => 'INT',
            ],
            'participant_id' => [
                'type' => 'INT',
            ],
            'timestamp' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('attendance_id', true);
        $this->forge->createTable('attendance');
    }

    public function down()
    {
        $this->forge->dropTable('attendance');
    }
}

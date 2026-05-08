<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToTables extends Migration
{
    public function up()
    {
        // Tambah user_id ke tabel meetings
        $this->forge->addColumn('meetings', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id',
            ],
        ]);

        // Tambah user_id ke tabel discussions
        $this->forge->addColumn('discussions', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id',
            ],
        ]);

        // Tambah user_id ke tabel participants
        $this->forge->addColumn('participants', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id',
            ],
        ]);

        // Tambah index untuk performa query
        $this->db->query('ALTER TABLE meetings ADD INDEX idx_meetings_user_id (user_id)');
        $this->db->query('ALTER TABLE discussions ADD INDEX idx_discussions_user_id (user_id)');
        $this->db->query('ALTER TABLE participants ADD INDEX idx_participants_user_id (user_id)');
    }

    public function down()
    {
        $this->forge->dropColumn('meetings', 'user_id');
        $this->forge->dropColumn('discussions', 'user_id');
        $this->forge->dropColumn('participants', 'user_id');
    }
}

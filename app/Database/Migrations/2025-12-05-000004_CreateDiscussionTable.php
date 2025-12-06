<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiscussionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'meeting_id'    => ['type' => 'INT', 'constraint' => 11],
            'topik'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'pembahasan'    => ['type' => 'TEXT'], // simpan array JSON nanti
            'tanggal'       => ['type' => 'DATE'],
            'nama_notulis'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('discussions');
    }

    public function down()
    {
        $this->forge->dropTable('discussions');
    }
}

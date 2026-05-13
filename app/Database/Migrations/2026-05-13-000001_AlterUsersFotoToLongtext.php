<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersFotoToLongtext extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('users', [
            'foto' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('users', [
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'default.png',
            ],
        ]);
    }
}

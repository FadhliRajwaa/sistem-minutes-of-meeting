<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixBarcodeUniqueConstraint extends Migration
{
    public function up()
    {
        // 1. Hapus UNIQUE constraint global pada barcode_id
        $this->db->query('ALTER TABLE participants DROP INDEX barcode_id');

        // 2. Tambah composite UNIQUE constraint (barcode_id + meeting_id)
        //    Agar barcode yang sama bisa dipakai di meeting berbeda
        $this->db->query('ALTER TABLE participants ADD UNIQUE INDEX idx_barcode_meeting (barcode_id, meeting_id)');
    }

    public function down()
    {
        // Rollback: hapus composite unique, kembalikan global unique
        $this->db->query('ALTER TABLE participants DROP INDEX idx_barcode_meeting');
        $this->db->query('ALTER TABLE participants ADD UNIQUE INDEX barcode_id (barcode_id)');
    }
}

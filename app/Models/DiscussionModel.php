<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscussionModel extends Model
{
    protected $table = 'discussions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'meeting_id',
        'topik',
        'pembahasan',
        'tanggal',
        'nama_notulis'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscussionModel extends Model
{
    protected $table = 'discussions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'meeting_id',
        'topik',
        'pembahasan',
        'tanggal',
        'nama_notulis'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get discussions milik user tertentu
     */
    public function getByUser(int $userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}

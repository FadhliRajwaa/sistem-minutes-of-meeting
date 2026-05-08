<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipantModel extends Model
{
    protected $table = 'participants';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'meeting_id', 'name', 'barcode_id', 'status', 'scanned_at'];
    protected $useTimestamps = true;

    /**
     * Get participants milik user tertentu per meeting
     */
    public function getByUserAndMeeting(int $userId, int $meetingId)
    {
        return $this->where('user_id', $userId)
                    ->where('meeting_id', $meetingId)
                    ->findAll();
    }
}

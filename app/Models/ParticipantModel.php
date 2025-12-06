<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipantModel extends Model
{
    protected $table = 'participants';
    protected $primaryKey = 'id';
    protected $allowedFields = ['meeting_id', 'name', 'barcode_id', 'status', 'scanned_at'];
    protected $useTimestamps = true;
}

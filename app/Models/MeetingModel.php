<?php

namespace App\Models;

use CodeIgniter\Model;

class MeetingModel extends Model
{
    protected $table      = 'meetings';
    protected $primaryKey = 'id'; 
    
    protected $useAutoIncrement = true; 

    protected $returnType     = 'array';
    protected $useSoftDeletes = false; 

    protected $allowedFields = ['user_id', 'nama_meeting', 'tanggal', 'tempat', 'status']; 

    protected $useTimestamps = true;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    /**
     * Get meetings milik user tertentu
     */
    public function getByUser(int $userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}

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

    protected $allowedFields = ['nama_meeting', 'tanggal', 'tempat', 'status']; 

    protected $useTimestamps = false; 
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
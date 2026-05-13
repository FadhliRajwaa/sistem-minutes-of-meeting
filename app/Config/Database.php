<?php
namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public $defaultGroup = 'default';

    public array $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'minuts-meeting',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'cacheOn'  => false,
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    /**
     * Database configuration for Aiven Cloud
     */
    public array $aiven = [
        'DSN'      => '',
        'hostname' => 'companyinterior-fadhlirajwaarahmana-9486.i.aivencloud.com',
        'username' => 'avnadmin',
        'password' => '', // Set via AIVEN_PASSWORD env variable
        'database' => 'minutes-of-meeting',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'cacheOn'  => false,
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'swapPre'  => '',
        'encrypt'  => true, // SSL Mode: REQUIRED
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 16722,
    ];

    public function __construct()
    {
        parent::__construct();

        // Check for Vercel/Environment override for default group
        if (getenv('DATABASE_DEFAULT_GROUP')) {
            $this->defaultGroup = getenv('DATABASE_DEFAULT_GROUP');
        }

        // Load Aiven credentials from Environment Variables if exists
        if (getenv('AIVEN_HOSTNAME')) {
            $this->aiven['hostname'] = getenv('AIVEN_HOSTNAME');
        }
        if (getenv('AIVEN_USERNAME')) {
            $this->aiven['username'] = getenv('AIVEN_USERNAME');
        }
        if (getenv('AIVEN_PASSWORD')) {
            $this->aiven['password'] = getenv('AIVEN_PASSWORD');
        }
    }
}



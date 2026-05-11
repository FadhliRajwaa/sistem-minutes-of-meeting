<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use DateTimeInterface;

class Cookie extends BaseConfig
{
    public string $prefix = '';

    /**
     * @var DateTimeInterface|int|string
     */
    public $expires = 0;

    public string $path = '/';

    public string $domain = '';

    /**
     * Auto-enable secure cookies on HTTPS (Vercel).
     * Required for SameSite=None to work.
     */
    public bool $secure = false;

    public bool $httponly = true;

    /**
     * Lax works well for most auth flows including OAuth redirects.
     */
    public string $samesite = 'Lax';

    public bool $raw = false;

    public function __construct()
    {
        parent::__construct();

        // Auto-enable secure cookies on HTTPS requests
        $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
                || (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on');
        
        if ($isHttps) {
            $this->secure = true;
        }
    }
}

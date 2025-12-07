<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public $clientID;
    public $clientSecret;
    public $redirectUri;

    public function __construct()
    {
        $this->clientID = getenv('GOOGLE_CLIENT_ID');
        $this->clientSecret = getenv('GOOGLE_CLIENT_SECRET');
        $this->redirectUri = getenv('GOOGLE_REDIRECT_URI') ?: base_url('auth/google-callback');
    }

    public $scopes = [
        'email',
        'profile',
    ];

    public $hostedDomain = null; // kalau login dibatasi domain, misal "example.com"
}

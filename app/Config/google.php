<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public $clientID     = '391089448293-v51fha2ivfvrrreht4t7t8faugu6kppf.apps.googleusercontent.com';
    public $clientSecret = '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';
    public $redirectUri  = 'http://localhost:8080/auth/google-callback';

    public $scopes = [
        'email',
        'profile',
    ];

    public $hostedDomain = null; // kalau login dibatasi domain, misal "example.com"
}

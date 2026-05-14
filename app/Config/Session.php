<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\BaseHandler;
use CodeIgniter\Session\Handlers\DatabaseHandler;
use CodeIgniter\Session\Handlers\FileHandler;

class Session extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Session Driver
     * --------------------------------------------------------------------------
     *
     * Use DatabaseHandler for serverless environments (Vercel).
     * FileHandler doesn't work in serverless because filesystem is ephemeral.
     *
     * @var class-string<BaseHandler>
     */
    public string $driver = DatabaseHandler::class;

    /**
     * --------------------------------------------------------------------------
     * Session Cookie Name
     * --------------------------------------------------------------------------
     */
    public string $cookieName = 'ci_session';

    /**
     * --------------------------------------------------------------------------
     * Session Expiration (1 day)
     * --------------------------------------------------------------------------
     */
    public int $expiration = 86400;

    /**
     * --------------------------------------------------------------------------
     * Session Save Path
     * --------------------------------------------------------------------------
     *
     * For DatabaseHandler, this is the table name.
     */
    public string $savePath = 'ci_sessions';

    /**
     * --------------------------------------------------------------------------
     * Session Match IP
     * --------------------------------------------------------------------------
     *
     * Disabled because Vercel uses different edge IPs for same user.
     */
    public bool $matchIP = false;

    /**
     * --------------------------------------------------------------------------
     * Session Time to Update
     * --------------------------------------------------------------------------
     *
     * On Vercel serverless, frequent regeneration causes race conditions
     * with concurrent AJAX requests. 1800s (30 min) is safe.
     */
    public int $timeToUpdate = 1800;

    /**
     * --------------------------------------------------------------------------
     * Session Regenerate Destroy
     * --------------------------------------------------------------------------
     *
     * MUST be false on Vercel serverless. When true, the old session row
     * is deleted immediately on regeneration — any concurrent request
     * still carrying the old cookie finds no session and gets logged out.
     */
    public bool $regenerateDestroy = false;

    /**
     * --------------------------------------------------------------------------
     * Session Database Group
     * --------------------------------------------------------------------------
     *
     * Use default group (will auto-switch to aiven via DATABASE_DEFAULT_GROUP env)
     */
    public ?string $DBGroup = null;

    /**
     * --------------------------------------------------------------------------
     * Lock Retry Interval (microseconds)
     * --------------------------------------------------------------------------
     */
    public int $lockRetryInterval = 100_000;

    /**
     * --------------------------------------------------------------------------
     * Lock Max Retries
     * --------------------------------------------------------------------------
     */
    public int $lockMaxRetries = 300;
}

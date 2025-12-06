<?php

/*
 |--------------------------------------------------------------------------
 | ERROR DISPLAY
 |--------------------------------------------------------------------------
 | Don't show ANY in production environments. Instead, let the system catch
 | it and display a generic error message.
 |
 | If you set 'display_errors' to '1', CI4's detailed error report will show.
 */
error_reporting(E_ALL & ~E_DEPRECATED);
// If you want to suppress more types of errors.
// error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);

    /*
     * --------------------------------------------------------------------------
     * Display Error (Debug Mode)
     * --------------------------------------------------------------------------
     *
     * If an error occurs, we want to see the details to debug it.
     */
    ini_set('display_errors', '1');
    defined('CI_DEBUG') || define('CI_DEBUG', true);

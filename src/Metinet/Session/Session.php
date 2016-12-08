<?php

namespace Metinet\Session;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class Session
{
    public function start()
    {
        if (PHP_SESSION_ACTIVE !== session_status()) {
            session_start();
        }
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }
}

<?php

namespace App\Classes;

class Session
{
    public static function sessionStart(): void
    {
        if (self::sessionExists()) {
            session_start();
        }
    }

    public static function additionalSessionStart(): bool
    {
        if (session_id()) {
            return false;
        } else {
            return session_start();
        }
    }

    public static function sessionExists(): bool
    {
        $result = false;
        $sessionName = session_name();
        if (isset($_COOKIE[$sessionName])) {
            $result = true;
        }
        return $result;
    }

    public static function set($title, $value)
    {
        $_SESSION[$title] = $value;
        return true;
    }

    public static function unset($title)
    {
        if (self::check($title)) {
            unset($_SESSION[$title]);
        }
        return true;
    }

    public static function get($title)
    {
        $result = null;
        if (self::check($title)) {
            $result = $_SESSION[$title];
        }
        return $result;
    }

    public static function check($title)
    {
        $result = false;
        if (isset($_SESSION[$title])) {
            $result = true;
        }
        return $result;
    }
}
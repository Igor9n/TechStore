<?php

namespace Core;

class Session
{
    private const PATH = '../storage/sessions';
    private const NAME = 'USID';

    private function __construct()
    {
    }

    public static function start()
    {
        if (self::cookieExists()) {
            return self::sessionStart();
        }
    }

    public static function sessionStart()
    {
        session_save_path(self::PATH);
        session_name(self::NAME);
        return session_start();
    }

    public static function cookieExists(): bool
    {
        if (isset($_COOKIE[self::NAME])) {
            return true;
        }
        return false;
    }

    public static function sessionExists(): bool
    {
        if (!session_id()) {
            return false;
        }
        return true;
    }

    public static function set($title, $value)
    {
        if (!self::sessionExists()) {
            self::sessionStart();
        }

        $_SESSION[$title] = $value;
        return true;
    }

    public function setArrayValue($title, $value)
    {
        $info = explode('/', $title);
        $_SESSION[$info[0]][$info[1]] = $value;
        return true;
    }

    public function getArrayValue($title)
    {
        $info = explode('/', $title);
        return $_SESSION[$info[0]][$info[1]];
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

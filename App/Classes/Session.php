<?php
namespace App\Classes;

class Session
{
    public static function sessionStart()
    {
        if ( self::sessionExists() )
        {
            session_start();
        }
    }
    public static function anotherSessionStart()
    {
        if ( session_id() )
        {
            return true;
        } else {
            return session_start();
        }
    }
//    public static function setAuth($log,$pass)
//    {
//        $_SESSION['login'] = $log;
//        $_SESSION['password'] = $pass;
//    }
    public static function sessionExists(): bool
    {
        $sessionName = session_name();
        if (isset($_COOKIE[$sessionName]))
        {
            return true;
        }
        return false;
    }
//    public static function destroy()
//    {
//        if ( self::sessionExists() )
//        {
//            unset($_SESSION['login']);
//            unset($_SESSION['password']);
//            session_destroy();
//        }
//    }
}
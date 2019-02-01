<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 01.02.19
 * Time: 15:02
 */

namespace Core;


class CustomRedirect
{
    protected static $url;

    public static function setUrl($uri, $host = BASE_SERVER): void
    {
        self::$url = $host . $uri;
    }

    public static function getUrl()
    {
        return self::$url;
    }

    public static function redirect($path): void
    {
        self::setUrl($path);
        $to = self::getUrl();
        Response::sendResponse(null, ['Location' => $to]);
    }
}
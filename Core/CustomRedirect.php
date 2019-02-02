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

    public static function setUrl($uri, $host): void
    {
        if (is_null($host)) {
            self::$url = $uri;
        } else {
            self::$url = $host . $uri;
        }
    }

    public static function getUrl()
    {
        return self::$url;
    }

    public static function redirect($path, $host = BASE_SERVER): void
    {
        self::setUrl($path, $host);
        $to = self::getUrl();
        Response::sendResponse(null, ['Location' => $to]);
    }

    public static function back(): void
    {
        self::redirect($_SERVER['HTTP_REFERER'], null);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 30.01.19
 * Time: 16:57
 */

namespace Core;


class Response
{
    protected static $headers;

    public static function sendResponse($view, $headers = USER_HEADERS)
    {
        self::setHeaders($headers);

        ob_start();
        self::sendHeaders();
        echo $view;
        ob_end_flush();
    }

    public static function setHeader($title, $value)
    {
        self::$headers[] = $title . ': ' . $value;
    }

    public static function setHeaders($headers)
    {
        foreach ($headers as $title => $value) {
            self::setHeader($title, $value);
        }
    }

    public static function sendHeaders()
    {
        foreach (self::getHeaders() as $header) {
            header($header);
        }
    }

    public static function getHeaders()
    {
        return self::$headers;
    }

}
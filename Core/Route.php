<?php

namespace Core;

class Route
{
    public static function errorPage404()
    {
        $view = new View();
        $view->render('404', ['title' => 'Not found']);
    }

    public static function checkExist($name, $array)
    {
        $result = false;
        if (in_array($name, $array)) {
            $result = true;
        }
        return $result;
    }

    public static function parseUri(): Request
    {
        $query = [];
        $uri = parse_url($_SERVER['REQUEST_URI']);

        if (isset($uri['query'])) {
            $query = $uri['query'];
        }
        return Request::setData($uri['path'], $query);
    }

    public static function start()
    {
        $var = false;
        $request = self::parseUri();
        $controllers = require APP_CONFIG . 'controllers.php';

        if (self::checkExist($request->getControllerName(), $controllers)) {
            $var = true;
            $path = $request->getPath();
            $controller = new $path();
        }

        $action = $request->getActionName();
        $key = $request->getActionKey();

        if ($var && method_exists($controller, $action)) {
            $controller->$action($key);
        } else {
            self::errorPage404();
        }
    }
}

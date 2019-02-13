<?php

namespace Core;

class Route
{
    /**
     * Just renders page with error
     */
    public static function errorPage404()
    {
        $view = new View();
        $view->initView('404', ['title' => 'Not found']);
    }

    /**
     * @param $name
     * @param $array
     * @return bool
     */
    public static function checkExist($name, $array): bool
    {
        $result = false;
        if (in_array($name, $array)) {
            $result = true;
        }
        return $result;
    }

    /**
     * @return Request object
     */
    public static function parseUri(): Request
    {
        $query = [];
        $uri = parse_url($_SERVER['REQUEST_URI']);

        if (isset($uri['query'])) {
            $query = $uri['query'];
        }
        return Request::setData($uri['path'], $query);
    }

    /**
     * Start routing
     */
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
        if ($var && method_exists($controller, $action)) {
            $controller->$action($request);
        } else {
            self::errorPage404();
        }
    }
}

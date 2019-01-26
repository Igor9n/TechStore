<?php

namespace Core;

class Route
{
    public static $controllerName = 'Main';
    public static $actionName = 'index';
    public static $actionId = null;

    public static function start()
    {
        Route::parseUrl();
        $controllers = require '../App/Config/controllers.php';
        if (Route::checkExist(Route::$controllerName, $controllers)) {
            if (preg_match('/^admin/', Route::$controllerName)) {
                $controllerName = '\\App\\Admin\\Controllers\\' . ucfirst(Route::$controllerName) . 'Controller';
            } else {
                $controllerName = '\\App\\User\\Controllers\\' . ucfirst(Route::$controllerName) . 'Controller';
            }

            $actionName = 'action' . ucfirst(Route::$actionName);

            $controller = new $controllerName();
            if (method_exists($controller, $actionName)) {
                $controller->$actionName(Route::$actionId);
            } else {
                Route::errorPage404();
            }
        } else {
            Route::errorPage404();
        }
    }

    public static function errorPage404()
    {
        $view = new View();
        $view->generate('template.php', '404.php', ['title' => 'Not found']);
    }

    public static function parseUrl()
    {
        $uriArray = parse_url($_SERVER['REQUEST_URI']);
        $routes = explode('/', $uriArray['path']);
        if (!empty($routes[1])) {
            Route::$controllerName = $routes[1];
        }
        // получаем имя экшена
        if (!empty($routes[2])) {
            Route::$actionName = $routes[2];
        }

        if (!empty($routes[3])) {
            Route::$actionId = $routes[3];
        }

        if (isset($uriArray['query'])) {
            $arr = explode('=', $uriArray['query']);
            $_GET[$arr[0]] = $arr[1];
        }
    }

    public static function checkExist($name, $array)
    {
        if (in_array(mb_strtolower($name), $array)) {
            return true;
        }
        Route::errorPage404();
    }
}
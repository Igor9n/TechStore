<?php

namespace Core;

class Route
{
    public static $controllerName = 'Main';
    public static $actionName = 'index';
    public static $actionId = '';

    public static function start()
    {
        Route::parseUrl();
        $controllers = require '../App/Config/controllers.php';
        if (Route::checkExist(Route::$controllerName, $controllers)){

            if (preg_match('/^admin/', Route::$controllerName)){
                $controllerName = '\\App\\Admin\\Controllers\\'.ucfirst(Route::$controllerName).'Controller';
            } else {
                $controllerName = '\\App\\Controllers\\'.ucfirst(Route::$controllerName).'Controller';
            }

            $actionName = 'action'.ucfirst(Route::$actionName);

            // создаем объект контроллера
            $controller = new $controllerName;
            if(method_exists($controller, $actionName))
            {
                $controller->$actionName(Route::$actionId);
            } else {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
            }

        } else {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }
    }

    public static function ErrorPage404()
    {
        $view = new View();
        $view->generate('template.php','404.php', ['title' => 'Not found']);
    }
    public static function parseUrl(){
        $uriArray = parse_url($_SERVER['REQUEST_URI']);
        $routes = explode('/', $uriArray['path']);
        if ( !empty($routes[1]) )
        {
            Route::$controllerName = $routes[1];
        }
        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            Route::$actionName = $routes[2];
        }

        if ( !empty($routes[3]) )
        {
            Route::$actionId = $routes[3];
        }

        if (isset($uriArray['query'])){
            $arr = explode('=',$uriArray['query']);
            $_GET[$arr[0]] = $arr[1];
        }
    }
    public static function checkExist($name,$array){
        if (in_array(mb_strtolower($name), $array)){
            return true;
        }
        Route::ErrorPage404();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 30.01.19
 * Time: 16:56
 */

namespace Core;


class Request
{
    protected $controllerName;
    protected $actionName;
    protected $actionKey;
    protected $params;
    protected $namespace;
    protected $path;

    public function __construct($controller, $action, $key, $query)
    {
        $this->setNamespace($controller);
        $this->setControllerName($controller);
        $this->setActionName($action);
        $this->setActionKey($key);
        $this->setParams($query);
        $this->setPath();
    }

    public static function setData($path, $query): Request
    {
        $routes = explode('/', $path);

        $controller = '';
        $action = '';
        $key = '';

        if (isset($routes[1])) {
            $controller = $routes[1];
        }
        if (isset($routes[2])) {
            $action = $routes[2];
        }
        if (isset($routes[3])) {
            $key = $routes[3];
        }

        return new self($controller, $action, $key, $query);
    }

    public function setNamespace($value)
    {
        if (preg_match('/^admin$/', $value)) {
            $this->namespace = '\\App\\Admin\\Controllers\\';
        } else {
            $this->namespace = '\\App\\User\\Controllers\\';
        }
    }

    public function getNamespace()
    {
        return $this->namespace;
    }


    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function setControllerName($value)
    {
        if (empty($value)) {
            $value = 'Main';
        }
        $this->controllerName = ucfirst($value) . CONTROLLER;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function setActionName($value)
    {
        if (empty($value)) {
            $value = 'Index';
        }
        $this->actionName = ACTION . ucfirst($value);
    }

    public function getActionKey()
    {
        return $this->actionKey;
    }

    public function setActionKey($value)
    {
        if (!empty($value)) {
            $this->actionKey = $value;
        }
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($value)
    {
        if (!empty($value)) {
            $listParams = explode('&', $value);

            foreach ($listParams as $param) {
                $value = explode('=', $param);
                $this->setParam($value[0], $value[1]);
            }
        }
    }

    public function setParam($title, $value)
    {
        $this->params[$title] = $value;
    }

    public function getParam($title)
    {
        $result = false;
        if (isset($this->params[$title])) {
            $result = $this->params[$title];
        }
        return $result;
    }

    public function setPath()
    {
        $this->path = $this->getNamespace() . $this->getControllerName();
    }

    public function getPath()
    {
        return $this->path;
    }
}
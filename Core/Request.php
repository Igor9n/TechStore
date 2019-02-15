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
    protected $getParams;
    protected $postParams;
    protected $namespace;
    protected $path;
//    protected $session;

    /**
     * Request constructor.
     * @param $controller
     * @param $action
     * @param $key
     * @param $query
     */
    public function __construct($controller, $action, $key, $query)
    {
        $this->setNamespace($controller);
        $this->setControllerName($controller);
        $this->setActionName($action);
        $this->setActionKey($key);
        $this->setParams($query);
        $this->setPostParams();
        $this->setPath();
//        $this->setSession();
    }

//    public function setSession()
//    {
//        $this->session = Session::getObject();
//    }

    /**
     * @param $path
     * @param $query
     * @return Request object
     */
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

    /**
     * @param $value
     */
    public function setNamespace($value)
    {
        if (preg_match('/^admin$/', $value)) {
            $this->namespace = ADMIN_NAMESPACE;
        } else {
            $this->namespace = USER_NAMESPACE;
        }
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @param $value
     */
    public function setControllerName($value)
    {
        if (empty($value)) {
            $value = 'Main';
        }
        $this->controllerName = ucfirst($value) . CONTROLLER;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @param $value
     */
    public function setActionName($value)
    {
        if (empty($value)) {
            $value = 'Index';
        }
        $this->actionName = ACTION . ucfirst($value);
    }

    /**
     * @return string
     */
    public function getActionKey(): string
    {
        return $this->actionKey;
    }

    /**
     * @param $value
     */
    public function setActionKey($value)
    {
        if (!empty($value)) {
            $this->actionKey = $value;
        }
    }

    /**
     *Return all GET params
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->getParams;
    }

    /**
     * Put one GET param into object
     *
     * @param $title
     * @param $value
     */
    public function setParam($title, $value)
    {
        $this->getParams[$title] = $value;
    }

    /**
     * Put GET params into object
     *
     * @param $value
     */
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

    /**
     * Returns needed GET param
     *
     * @param $title
     * @return bool
     */
    public function getParam($title)
    {
        $result = false;
        if (isset($this->getParams[$title])) {
            $result = $this->getParams[$title];
        }
        return $result;
    }

    /**
     * Path to for controller
     */
    public function setPath()
    {
        $this->path = $this->getNamespace() . $this->getControllerName();
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Put one POST param into object
     *
     * @param $title
     * @param $value
     */
    public function setPostParam($title, $value)
    {
        $this->postParams[$title] = $value;
    }

    /**
     * Returns needed POST param
     *
     * @param $title
     * @return bool
     */
    public function getPostParam($title)
    {
        $result = false;
        if (isset($this->postParams[$title])) {
            $result = $this->postParams[$title];
        }
        return $result;
    }

    /**
     * Returns all POST params
     *
     * @return array
     */
    public function getPostParams(): array
    {
        return $this->postParams;
    }

    /**
     * Put POST params into object
     */
    public function setPostParams()
    {
        if (!empty($_POST)) {
            foreach ($_POST as $title => $param) {
                $this->setPostParam($title, $param);
            }
        }
    }
}
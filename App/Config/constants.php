<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 31.01.19
 * Time: 11:04
 */

define("CONTROLLER", 'Controller');
define("ACTION", 'action');

define("USER_RESOURCES", '../App/User/resources/');
define("USER_TEMPLATE", '../App/User/patterns/');
define("USER_VIEWS", '../App/User/views/');
define("USER_ELEMENTS", [
    'header' => USER_RESOURCES,
    'footer' => USER_RESOURCES,
    'arrivals' => USER_RESOURCES,
    'categories' => USER_RESOURCES,
    'scripts' => USER_RESOURCES
]);
define("USER_HEADERS", [
    'Content-Type' => 'text/html;charset=UTF-8',
    "Cache-Control" => 'no-cache, must-revalidate'
]);

define("PHP_EXT", '.php');

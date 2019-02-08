<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 31.01.19
 * Time: 11:04
 */

define("CONTROLLER", 'Controller');
define("ACTION", 'action');
define("CATEGORY", 'category');
define("BASE_SERVER", 'http://localhost/');
define("REGISTERED", 'registered');

define("USER_RESOURCES", '../App/User/resources/');
define("APP_CONFIG", '../App/Config/');
define("USER_CONTROLLERS", '../App/User/Controllers/');
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

define("ADMIN_RESOURCES", '../App/Admin/resources/');
define("ADMIN_CONTROLLERS", '../App/Admin/Controllers/');
define("ADMIN_TEMPLATE", '../App/Admin/patterns/');
define("ADMIN_VIEWS", '../App/Admin/views/');
define("ADMIN_ELEMENTS", [
    'header' => ADMIN_RESOURCES,
    'footer' => ADMIN_RESOURCES,
    'scripts' => USER_RESOURCES
]);

define("ADMIN_NAMESPACE", '\App\Admin\Controllers\\');
define("USER_NAMESPACE", '\App\User\Controllers\\');

define("PHP_EXT", '.php');
define("TECH_STORE", ['igr2007forever@gmail.com' => 'TechStore']);

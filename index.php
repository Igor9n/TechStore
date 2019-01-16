<?php
ini_set('display_errors', 1);
require __DIR__.'/vendor/autoload.php';

App\Classes\Session::sessionStart();
var_dump($_POST);
App\Core\Route::start();

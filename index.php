<?php
ini_set('display_errors', 1);
require __DIR__.'/vendor/autoload.php';

App\Classes\Session::sessionStart();

App\Core\Route::start();

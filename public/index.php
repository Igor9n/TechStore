<?php
ini_set('display_errors', 1);
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../App/Config/constants.php';

use Core\Route;
use App\Classes\Session;
use Core\CustomRedirect;

Session::sessionStart();
Route::start();

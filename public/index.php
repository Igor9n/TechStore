<?php
ini_set('display_errors', 1);
require __DIR__ . '/../vendor/autoload.php';

use Core\Route;
use App\Classes\Session;

Session::sessionStart();

Route::start();

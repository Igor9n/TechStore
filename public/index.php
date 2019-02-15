<?php
ini_set('display_errors', 1);
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../App/Config/constants.php';
require __DIR__ . '/../Core/Mailer/config/constants.php';

use Core\{Route, Session};

Session::start();

Route::start();

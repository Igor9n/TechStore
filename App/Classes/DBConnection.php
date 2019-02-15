<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 15:12
 */

namespace App\Classes;

use PDO;

class DBConnection
{
    private static $instance;

    public static function getInstance(): PDO
    {
        if (null === static::$instance) {
            $config = require '../App/Config/db.php';
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $config['host'], $config['db'], $config['charset']);
            static::$instance = new PDO(
                $dsn,
                $config['user'],
                $config['password']
            );
        }
        return static::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}

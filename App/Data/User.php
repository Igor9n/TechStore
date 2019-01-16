<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:02
 */
namespace App\Data;

class User
{
    public $id;
    public $login;
    public $email;

    public function __construct() {
    }

    public static function createObject(): User {
        return new self(
        );
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 21.01.19
 * Time: 10:02
 */

namespace App\Admin\Data;


class Admin
{
    public $login;
    public $password;
    public $role;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public static function createObject($login, $password): Admin
    {
        return new self(
            $login,
            $password
        );
    }

    public function fillRole($role)
    {
        $this->role = $role;
    }

    public function clearPassword()
    {
        unset($this->password);
    }
}
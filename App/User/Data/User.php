<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:02
 */

namespace App\User\Data;

class User
{
    public $id;
    public $login;
    public $password;
    public $confirmPassword;
    public $email;
    public $orders;

    public function __construct($login, $password, $confirmPassword, $email)
    {
        $this->login = $login;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->email = $email;
    }

    public static function createObject($login, $password, $confirmPassword = '', $email = ''): User
    {
        return new self(
            $login,
            $password,
            $confirmPassword,
            $email
        );
    }

    public function fillId($id)
    {
        $this->id = $id;
    }

    public function fillOrders($list)
    {
        $this->orders = $list;
    }

    public function clearPassword()
    {
        unset($this->password);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.01.19
 * Time: 20:37
 */

namespace App\User\Models;


use Core\Model;

class UserModel extends Model
{
    public $userIdQuery;

    public function __construct()
    {
        parent::__construct();
        $this->userIdQuery = "SELECT id FROM users WHERE login = :login";
    }


    public function checkUserForRegInDB($login = '', $email = '')
    {
        $errors = [];
        $check = "SELECT login FROM users WHERE login = :login OR email = :email";
        if ($this->queryColumn($check, ['login' => $login, 'email' => $email], 0)) {
            $errors['inBase'] = 'User is already registered';
        }
        return $errors;
    }

    public function checkUserForLogInDB($login)
    {
        $errors = [];
        if (!$this->queryColumn($this->userIdQuery, ['login' => $login], 0)) {
            $errors['notInBase'] = 'This user is not registered';
        }
        return $errors;
    }

    public function checkPasswordForLogin($login, $password)
    {
        $errors = [];
        $check = "SELECT password FROM users WHERE login = :login";
        $hash = $this->queryColumn($check, ['login' => $login], 0);
        if (!password_verify($password, $hash)) {
            $errors['dbPassError'] = 'Wrong password';
        }
        return $errors;
    }

    public function getUserId($login)
    {
        return $this->queryColumn($this->userIdQuery, ['login' => $login], 0);
    }

    public function registerUser($log, $pass, $email)
    {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $register = "INSERT INTO users (login, password, email) VALUES (:login, :password, :email)";
        $this->queryColumn($register, [
            'login' => $log,
            'password' => $pass,
            'email' => $email
        ]);
        return true;
    }
}
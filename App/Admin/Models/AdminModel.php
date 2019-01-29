<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 21.01.19
 * Time: 10:02
 */

namespace App\Admin\Models;


use Core\Model;

class AdminModel extends Model
{
    public function checkAdminForLogInDB($login)
    {
        $errors = [];
        $query = "SELECT id FROM admins WHERE login = :login";
        if (!$this->queryColumn($query, ['login' => $login], 0)) {
            $errors['notInBase'] = 'This admin is not registered';
        }
        return $errors;
    }

    public function checkPasswordForLogin($login, $password)
    {
        $errors = [];
        $check = "SELECT password FROM admins WHERE login = :login";
        $hash = $this->queryColumn($check, ['login' => $login], 0);
        if (!password_verify($password, $hash)) {
            $errors['dbPassError'] = 'Wrong password';
        }
        return $errors;
    }

    public function getAdminRole(string $login)
    {
        $query = "SELECT role FROM admins WHERE login = :login";
        return $this->queryColumn($query, ['login' => $login], 'role');
    }
}


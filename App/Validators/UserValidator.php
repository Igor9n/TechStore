<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 24.01.19
 * Time: 17:39
 */

namespace App\Validators;


class UserValidator
{
    public function validateLogin($log)
    {
        $errors = [];
        if (!preg_match('/^[a-zA-Z0-9]+$/', $log)) {
            $errors['loginError'] = 'Login must include only numbers or english characters';
        }
        if (strlen($log) < 4 || strlen($log) > 12) {
            $errors['loginCount'] = 'Login must have min 4 and max 12 symbols';
        }
        return $errors;
    }

    public function validatePassword($password)
    {
        $errors = [];
        if (!preg_match('/^[a-zA-Z0-9$#%]+$/', $password)) {
            $errors['passwordError'] = 'Password must include only numbers, english characters, $, % or #';
        }
        if (strlen($password) < 8 || strlen($password) > 20) {
            $errors['passwordCount'] = 'Password must have min 8 and max 20 symbols';
        }
        return $errors;
    }

    public function validateConfirm($password, $confirm)
    {
        $errors = [];
        if ($password !== $confirm) {
            $errors['confirmPass'] = 'Your passwords are different';
        }
        return $errors;
    }

    public function validateEmail($email)
    {
        $error = [];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['emailError'] = 'Enter correct email';
        }
        return $error;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.01.19
 * Time: 20:37
 */

namespace App\Models;


use App\Core\Model;

class UserModel extends Model
{
    public $userIdQuery;

    public function __construct()
    {
        parent::__construct();
        $this->userIdQuery = "SELECT id FROM users WHERE login = :login";
    }
    public function validateLogin($log) {
        echo $log;
       $errors = [];
       if(!preg_match('/^[a-zA-Z0-9]+$/',$log)){
           $errors['loginError'] = 'Login must include only numbers or english characters';
       }
       if(strlen($log) < 4 || strlen($log) > 12){
           $errors['loginCount'] = 'Login must have min 4 and max 12 symbols';
       }
       return $errors;
    }
    public function validatePassword($flag,$pass,$confirm = '') {
        $errors = [];
        if(!preg_match('/^[a-zA-Z0-9$#%]+$/',$pass)){
            $errors['passwordError'] = 'Password must include only numbers, english characters, $, % or #';
        }
        if(strlen($pass) < 8 || strlen($pass) > 20){
            $errors['passwordCount'] = 'Password must have min 8 and max 20 symbols';
        }
        switch ($flag){
            case 'reg':
                if($pass !== $confirm){
                    $errors['confirmPass'] = 'Your passwords are different';
                }
                return $errors;
            case 'log':
                return $errors;
            default:
                return $errors;
        }
    }
    public function validateEmail($email) {
        $error = [];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['emailError'] = 'Enter correct email';
        }
        return $error;
    }

    public function checkLoginInDB($flag, $login = '',$email = '') {
        $errors = [];
        switch ($flag) {
            case 'reg': // Is user already in db?
                $check ="SELECT login FROM users WHERE login = :login OR email = :email";
                if ($this->queryOne($check,['login' => $login,'email' => $email], 0)) {
                    $errors['inBase'] = 'User is already registered';
                    return $errors;
                }
                return false;
            case 'log': // Is user registered?
                if ($this->queryOne($this->userIdQuery,['login' => $login],0)) {
                    return false;
                } else {
                    $errors['notInBase'] = 'This user is not registered';
                    return $errors;
                }
            default:
                return $errors;
        }
    }
    public function checkLoginPassword($login, $password) {
        $errors = [];
        $check = "SELECT password FROM users WHERE login = :login";
        $hash = $this->queryOne($check, ['login' => $login], 0 );
        if (password_verify($password,$hash)) {
                return $errors;
            } else {
                $errors['dbPassError'] = 'Wrong password';
                return $errors;
            }
    }

    public function getUserId($login) {
        return $this->queryOne($this->userIdQuery, ['login' => $login], 0);
    }
    public function registerUser($log,$pass,$email){
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $register = "INSERT INTO users (login, password, email) VALUES (:login, :password, :email)";
        $this->queryOne($register, [
            'login' => $log,
            'password' => $pass,
            'email' => $email
        ]);
        return true;
    }
}
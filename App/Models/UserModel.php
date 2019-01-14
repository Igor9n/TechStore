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
    public function __construct()
    {
        parent::__construct();
    }
    public function validateLogin($log){
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
    public function validatePassword($flag,$pass,$confirm = ''){
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
    public function validateEmail($email){
        $error = [];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['emailError'] = 'Enter correct email';
        }
        return $error;
    }
    public function checkLogin($flag, $login = '',$email = ''){
        switch ($flag) {
            case 'reg':
                $check = $this->pdo->prepare('SELECT login FROM users WHERE login = ? OR email = ?');
                $check->execute([$login,$email]);
                if ($check->fetchAll()) {
                    return 'User is already registered';
                }
                return false;
            case 'log':
                $check = $this->pdo->prepare('SELECT id FROM users WHERE login = ?');
                $check->execute([$login]);

                if ($stmn = $check->fetchColumn()) {
                    return null;
                } else {
                    return 'This user is not registered';
                }
            case 'id':
                $check = $this->pdo->prepare('SELECT id, login FROM users WHERE login = ?');
                $check->execute([$login]);
                return $check->fetchAll();
            default:
                return null;
        }
    }
    public function checkLoginInfo($login,$password){
        $errors = [];
        $error = $this->checkLogin('log',$login);
        if ($error){
            $errors['loginError'] = $error;
            return $errors;
        } else {
            $check = $this->pdo->prepare('SELECT password FROM users WHERE login = ?');
            $check->execute([$login]);
            $hash = $check->fetchColumn();
            if (password_verify($password,$hash)){
                return null;
            } else {
                $errors['dbPassError'] = 'Wrong password';
                return $errors;
            }
        }
    }
    public function checkForErrors($array,$flag){
        $errors = [];
        switch ($flag){
            case 'reg':
                $check['loginErrors'] = $this->validateLogin($array['login']);
                $check['passwordErrors'] = $this->validatePassword('reg',$array['password'],$array['confirm']);
                $check['emailErrors'] = $this->validateEmail($array['email']);
                foreach ($check as $value){
                    if (isset($value)){
                        foreach ($value as $var){
                            $errors[] = $var;
                        }
                    }
                }
                return $errors;
            case 'log':
                $check['loginErrors'] = $this->validateLogin($array['login']);
                $check['passwordErrors'] = $this->validatePassword($flag, $array['password']);
                foreach ($check as $value){
                    if (isset($value)){
                        foreach ($value as $var){
                            $errors[] = $var;
                        }
                    }
                }
                return $errors;
            default:
                return null;
        }
    }
    public function registerUser($log,$pass,$email){
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $register = $this->pdo->prepare('INSERT INTO users (`login`, `password`, `email`) VALUES (?, ?, ?)');
        $register->execute([$log,$pass,$email]);
    }
    public function getInfoFromPost($flag){
        switch ($flag) {
            case 'reg':
                return [
                    'login' => $_POST['login'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'confirm' => $_POST['confirm'],
                ];
            case 'log':
                return[
                    'login' => $_POST['login'],
                    'password' => $_POST['password']
                ];
            default:
                return null;
        }
    }
}
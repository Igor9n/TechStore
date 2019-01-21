<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:03
 */
namespace App\Mappers;

use App\Classes\Session;
use Core\Mapper;
use App\Data\User;
use App\Models\UserModel;

class UserMapper extends Mapper
{
    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function getObject($flag): User
    {
        switch ($flag) {
            case 'log':
                return User::createObject(
                    $_POST['login'],
                    $_POST['password']
                );
            case 'reg':
                return User::createObject(
                    $_POST['login'],
                    $_POST['password'],
                    $_POST['confirm'],
                    $_POST['email']
                );
        }
    }

    public function validateInfo(User $object, $flag)
    {
        switch ($flag){
            case 'log':
                $check['loginErrors'] = $this->model->validateLogin($object->login);
                $check['passwordErrors'] = $this->model->validatePassword($object->password);
                return $this->makeSimpleArray($check);
            case 'reg':
                $check['loginErrors'] = $this->model->validateLogin($object->login);
                $check['passwordErrors'] = $this->model->validatePassword($object->password);
                $check['confirmError'] = $this->model->validateConfirm($object->password,$object->confirmPassword);
                $check['emailErrors'] = $this->model->validateEmail($object->email);
                return $this->makeSimpleArray($check);
            default:
                return ['Invalid input data'];
        }

    }

    public function checkForErrors(User $object, $flag)
    {
        $errors = $this->validateInfo($object, $flag);
        switch ($flag){
            case 'log':
                if (empty($errors)) {
                    $errors = $this->model->checkLoginInDB($flag, $object->login);
                }
                if (empty($errors)){
                    $errors = $this->model->checkLoginPassword($object->login, $object->password);
                }
                return $errors;
            case 'reg':
                if (empty($errors)) {
                    return $this->model->checkLoginInDB($flag, $object->login);
                }
                return $errors;
            default:
                return $errors;
        }
    }

    public function addId(User $object)
    {
        $object->fillId($this->model->getUserId($object->login));
    }

    public function submitUserInfo(User $object)
    {
        return $this->model->registerUser(
            $object->login,
            $object->password,
            $object->email
        );
    }

    public function loginUser($errors,$user)
    {
        if (empty($errors)) {
            Session::anotherSessionStart();
            $this->addId($user);
            $_SESSION['user'] = $user;
            unset($_SESSION['user']->password);
        } else {
            $_SESSION['errors'] = $errors;
        }
        header("Location: /user/login");
    }
    public function registerUser($errors,$user)
    {
        if (empty($errors)) {
            $_SESSION['registered'] = $this->submitUserInfo($user);
        } else {
            $_SESSION['errors'] = $errors;
        }
        header("Location: /user/registration");
    }

    public function addOrdersInfo(User $user, $list) {
        $user->fillOrders($list);
    }
}
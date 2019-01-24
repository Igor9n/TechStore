<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:03
 */

namespace App\Mappers;

use App\Classes\Session;
use App\Validators\UserValidator;
use Core\Mapper;
use App\Data\User;
use App\Models\UserModel;

class UserMapper extends Mapper
{
    public function __construct()
    {
        $this->model = new UserModel();
        $this->validator = new UserValidator();
    }

    public function getObject($flag): User
    {
        if ($flag === 'login') {
            return User::createObject(
                $_POST['login'],
                $_POST['password']
            );
        } else {
            return User::createObject(
                $_POST['login'],
                $_POST['password'],
                $_POST['confirm'],
                $_POST['email']
            );
        }
    }

    public function validateLoginInfo(User $object)
    {
        $check[] = $this->validator->validateLogin($object->login);
        $check[] = $this->validator->validatePassword($object->password);
        return $this->makeSimpleArray($check);
    }

    public function validateRegisterInfo(User $object)
    {
        $check[] = $this->validator->validateLogin($object->login);
        $check[] = $this->validator->validatePassword($object->password);
        $check[] = $this->validator->validateConfirm($object->password, $object->confirmPassword);
        $check[] = $this->validator->validateEmail($object->email);
        return $this->makeSimpleArray($check);
    }


    public function loginErrors(User $object)
    {
        $errors = $this->validateLoginInfo($object);

        if (empty($errors)) {
            $errors = $this->model->checkUserForLogInDB($object->login);
        }

        if (empty($errors)) {
            $errors = $this->model->checkPasswordForLogin($object->login, $object->password);
        }
        return $errors;
    }

    public function registerErrors(User $object)
    {
        $errors = $this->validateRegisterInfo($object);

        if (empty($errors)) {
            return $this->model->checkUserForRegInDB($object->login, $object->email);
        }
        return $errors;
    }

    public function addId(User $object)
    {
        $object->fillId($this->model->getUserId($object->login));
    }

    public function addOrdersInfo(User $user, $list)
    {
        $user->fillOrders($list);
    }

    public function submitUserInfo(User $object)
    {
        return $this->model->registerUser(
            $object->login,
            $object->password,
            $object->email
        );
    }

    public function loginUser(User $user, array $errors)
    {
        if (empty($errors)) {
            $this->addId($user);
            $user->clearPassword();
            Session::set('user', $user);
        } else {
            Session::set('errors', $errors);
        }
        header("Location: /user/login");
    }

    public function registerUser(User $user, array $errors)
    {
        if (empty($errors)) {
            Session::set('registered', $this->submitUserInfo($user));
        } else {
            Session::set('errors', $errors);
        }
        header("Location: /user/registration");
    }
}

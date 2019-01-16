<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:03
 */
namespace App\Mappers;

use App\Core\Mapper;
use App\Data\User;
use App\Models\UserModel;

class UserMapper extends Mapper
{
    public function __construct() {
        $this->model = new UserModel();
    }

    public function getObject($flag): User {
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
                    $_POST['confirmPassword'],
                    $_POST['email']
                );
        }
    }

    public function validateInfo(User $object, $flag) {
        switch ($flag){
            case 'log':
                $check['loginErrors'] = $this->model->validateLogin($object->login);
                $check['passwordErrors'] = $this->model->validatePassword($flag, $object->password);
                return $this->makeSimpleArray($check);
            case 'reg':
                $check['loginErrors'] = $this->model->validateLogin($object->login);
                $check['passwordErrors'] = $this->model->validatePassword($flag,$object->password,$object->confirmPassword);
                $check['emailErrors'] = $this->model->validateEmail($object->email);
                return $this->makeSimpleArray($check);
            default:
                return null;
        }

    }

    public function checkForErrors(User $object, $flag){
        switch ($flag){
            case 'log':
                $errors = $this->validateInfo($object, $flag);
                if (empty($errors)) {
                    return $this->model->checkLoginPassword($object->login, $object->password);
                } else {
                    return $errors;
                }
            case 'reg':
                $errors = $this->validateInfo($object, $flag);
                if (empty($errors)) {

                }
                return $errors;
            default:
                return null;
        }
    }

    public function addId(User $object) {
        $object->fillId($this->model->getUserId($object->login));
    }
}
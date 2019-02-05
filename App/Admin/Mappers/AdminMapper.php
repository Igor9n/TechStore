<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 21.01.19
 * Time: 10:02
 */

namespace App\Admin\Mappers;

use App\Admin\Data\Admin;
use App\Admin\Main\MainMapper;
use App\Admin\Models\AdminModel;
use App\Admin\Validators\AdminValidator;
use App\Classes\Session;
use Core\Request;

class AdminMapper extends MainMapper
{
    public function __construct()
    {
        $this->model = new AdminModel();
        $this->validator = new AdminValidator();
    }

    /**
     * @var $request Request
     * @return Admin
     */
    public function getObject(): Admin
    {
        return Admin::createObject(
            $_POST['login'],
            $_POST['password']
        );
    }

    public function validateLoginInfo(Admin $object)
    {
        $check[] = $this->validator->validateLogin($object->login);
        $check[] = $this->validator->validatePassword($object->password);
        return $this->makeSimpleArray($check);
    }

    public function loginErrors(Admin $object)
    {
        $errors = $this->validateLoginInfo($object);

        if (empty($errors)) {
            $errors = $this->model->checkAdminForLogInDB($object->login);
        }

        if (empty($errors)) {
            $errors = $this->model->checkPasswordForLogin($object->login, $object->password);
        }
        return $errors;
    }

    public function loginAdmin(Admin $admin)
    {
        Session::additionalSessionStart();
        $this->addRole($admin);
        $admin->clearPassword();
        Session::set('admin', $admin);

        return [];
    }

    public function addRole(Admin $object)
    {
        $object->fillRole($this->model->getAdminRole($object->login));
    }

    public function chooseController($key)
    {
        $result = false;

        if ($key === 'categories' || $key === 'category') {
            $result = 'categories';
        }

        if (!$result && ($key === 'items' || $key === 'item')) {
            $result = 'item';
        }

        if (!$result && ($key === 'orders' || $key === 'order')) {
            $result = 'order';
        }

        return $result;
    }
}

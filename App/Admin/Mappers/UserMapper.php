<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.02.19
 * Time: 13:24
 */

namespace App\Admin\Mappers;

use App\Admin\Data\User;
use App\Admin\Main\MainMapper;
use App\Admin\Models\UserModel;
use App\Admin\Validators\UserValidator;

class UserMapper extends MainMapper
{
    public function __construct()
    {
        $this->model = new UserModel();
        $this->validator = new UserValidator();
    }

    public function getObject($id, array $array): User
    {
        return User::getObject(
            $id,
            $array['login'],
            $array['email'],
            $array['personalList']
        );
    }

    public function getUserObject($id)
    {

    }

    public function updatePersonalInfo(array $info)
    {
        return $this->model->updatePersonalInfo(
            $info['id'],
            $info['firstName'],
            $info['lastName'],
            $info['phoneNumber'],
            $info['email']
        );
    }

    public function updateAddressInfo(array $info)
    {
        return $this->model->updateAddressInfo(
            $info['id'],
            $info['city'],
            $info['address'],
            $info['apartmentsNumbers'],
            $info['zip']
        );
    }

    public function update(array $info)
    {
        $result = null;
        if ($info['what'] === 'personal') {
            $result = $this->updatePersonalInfo($info);
        } elseif ($info['what'] === 'address') {
            $result = $this->updateAddressInfo($info);
        }
        return $result;
    }

    public function validatePersonal(array $data)
    {
        $errors[] = $this->validator->validateFirstName($data['firstName']);
        $errors[] = $this->validator->validateLastName($data['lastName']);
        $errors[] = $this->validator->validatePhone($data['phoneNumber']);
        if (!empty($data['email'])) {
            $errors[] = $this->validator->validateEmail($data['email']);
        }
        return $this->makeSimpleArray($errors);
    }

    public function validateAddress(array $data)
    {
        $errors[] = $this->validator->validateCity($data['city']);
        $errors[] = $this->validator->validateAddress($data['address']);
        $errors[] = $this->validator->validateApartments($data['apartmentsNumbers']);
        if (!empty($data['zip'])) {
            $errors[] = $this->validator->validateZip($data['zip']);
        }
        return $this->makeSimpleArray($errors);
    }

    public function checkForErrors(array $info)
    {
        $errors = [];

        if ($info['what'] === 'personal') {
            $errors['list'] = $this->validatePersonal($info);
        } elseif ($info['what'] === 'address') {
            $errors['list'] = $this->validateAddress($info);
        }
        $errors['action'] = $info['action'];
        $errors['what'] = $info['what'];

        return $errors;
    }
}

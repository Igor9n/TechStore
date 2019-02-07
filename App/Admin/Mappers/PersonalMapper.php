<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 07.02.19
 * Time: 15:07
 */

namespace App\Admin\Mappers;

use App\Admin\Data\Personal;
use App\Admin\Main\MainMapper;
use App\Admin\Models\UserModel;
use App\Admin\Validators\UserValidator;

class PersonalMapper extends MainMapper
{
    public $user;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->validator = new UserValidator();
    }

    public function getObject(array $array, $order): Personal
    {
        return Personal::getObject($array, $order);
    }

    public function getPersonalObject($id): Personal
    {

        $order = $this->model->getPersonalOrderId($id);
        $info['personal'] = $this->model->getFullPersonalInfo($id);
        $info['user'] = $this->model->getFullUserInfo($info['personal']['user_id']);
        $info['address'] = $this->model->getFullAddressInfo($id);

        return $this->getObject($info, $order);
    }

    public function getAllPersonals()
    {
        $array = [];
        $list = $this->model->getPersonalIdList();

        foreach ($list as $personal) {
            $array[] = $this->getPersonalObject($personal);
        }

        return $array;
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

    public function updateUserID(array $info)
    {
        return $this->model->updatePersonalUserID($info['id'], $info['user']);
    }

    public function update(array $info)
    {
        $result = null;
        if ($info['what'] === 'personal') {
            $result = $this->updatePersonalInfo($info);
        } elseif ($info['what'] === 'address') {
            $result = $this->updateAddressInfo($info);
        } elseif ($info['what'] === 'user') {
            $result = $this->updateUserID($info);
        }
        return $result;
    }

    public function delete(array $info)
    {
        return [
            $this->model->deleteAddress($info['addressId']),
            $this->model->deletePersonal($info['id'])
        ];
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
<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.02.19
 * Time: 13:24
 */

namespace App\Admin\Mappers;

use App\Admin\Main\MainMapper;
use App\Admin\Models\UserModel;

class UserMapper extends MainMapper
{
    public function __construct()
    {
        $this->model = new UserModel();
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

    public function checkForErrors()
    {
        return [];
    }
}
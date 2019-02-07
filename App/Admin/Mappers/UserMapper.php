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
    public $personal;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->validator = new UserValidator();
        $this->personal = new PersonalMapper();
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

    public function getUserObject($id): User
    {
        $info = $this->model->getFullUserInfo($id);
        $personals = $this->model->getPersonalIdListByUser($id);

        $array = [];
        foreach ($personals as $personal) {
            $array[] = $this->personal->getPersonalObject($personal);
        }

        return $this->getObject($id, [
            'login' => $info['login'],
            'email' => $info['email'],
            'personalList' => $array
        ]);
    }

    public function getAllUsers()
    {
        $array = [];
        $list = $this->model->getUsersIDList();
        foreach ($list as $id) {
            $array[] = $this->getUserObject($id);
        }
        return $array;
    }

    public function update(array $info)
    {
        return $this->model->updateUserEmail($info['id'], $info['email']);
    }

    public function delete(array $info)
    {
        return $this->model->deleteUser($info['id']);
    }

    public function checkForErrors()
    {
        return [];
    }
}

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

    public function getObject(): User {
        return User::createObject();
    }

}
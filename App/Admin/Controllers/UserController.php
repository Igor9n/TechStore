<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.02.19
 * Time: 15:45
 */

namespace App\Admin\Controllers;

use App\Admin\Main\MainController;
use App\Admin\Mappers\UserMapper;

class UserController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->mapper = new UserMapper();
    }

}
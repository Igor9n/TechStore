<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.02.19
 * Time: 15:45
 */

namespace App\Admin\Controllers;

use App\Admin\Main\MainController;
use App\Admin\Mappers\PersonalMapper;
use App\Admin\Mappers\UserMapper;
use Core\Request;

class UserController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->mapper = new UserMapper();
        $this->characteristics = new PersonalMapper();
    }

    public function actionDelete(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionUpdate(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionAll()
    {
        $data['title'] = 'All users';
        $data['users'] = $this->mapper->getAllUsers();
        $data['personals'] = $this->characteristics->getAllPersonals();
        $data['errors'] = $this->getErrors();

        $this->view->render('admin_users', $data);
    }
}

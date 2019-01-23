<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 21.01.19
 * Time: 9:50
 */

namespace App\Admin\Controllers;


use Core\Controller;
use App\Admin\Main\AdminView;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->view= new AdminView();
    }

    public function actionLogin()
    {
        $data['title'] = 'Admin login';
        $this->view->generate('admin_template.php','admin_login.php', $data);
    }

    public function actionIndex()
    {
        if(!isset($_SESSION['admin'])){
            header("Location: /admin/login");
        }

        $data['title'] = 'Admin page';
        $this->view->generate('admin_template.php','admin_main.php', $data);
    }
}
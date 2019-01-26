<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 21.01.19
 * Time: 9:50
 */

namespace App\Admin\Controllers;


use App\Admin\Mappers\AdminMapper;
use App\Admin\Mappers\CategoryMapper;
use App\Classes\Session;
use Core\Controller;
use App\Admin\Main\AdminView;

class AdminController extends Controller
{
    public $categories;

    public function __construct()
    {
        $this->view = new AdminView();
        $this->mapper = new AdminMapper();
        $this->categories = new CategoryMapper();
    }

    public function try(string $action)
    {
        $method = $action . 'Admin';
        $errors = $action . 'Errors';

        $admin = $this->mapper->getObject();
        $errors = $this->mapper->$errors($admin, $action);

        if (empty($errors)) {
            $errors = $this->mapper->$method($admin, $errors);
        }

        return $errors;
    }

    public function actionLogout()
    {
        Session::unset('admin');
        header("Location: /admin/login");
    }

    public function actionLogin()
    {
        if (isset($_POST['try'])) {
            $data['errors'] = $this->try($_POST['try']);
        }

        if (Session::check('admin')) {
            header("Location: /admin");
        }

        $data['title'] = 'Admin login';
        $this->view->generate('admin_template.php', 'admin_login.php', $data);
    }

    public function actionIndex()
    {
        if (!Session::check('admin')) {
            header("Location: /admin/login");
        }

        $data['title'] = 'Admin page';
        $this->view->generate('admin_template.php', 'admin_main.php', $data);
    }

    public function actionCategories()
    {
        if (!Session::check('admin')) {
            header("Location: /admin/login");
        }

        $data['categories'] = $this->categories->getAllCategories();
        $data['title'] = 'Categories page';

        $this->view->generate('admin_template.php', 'admin_categories.php', $data);
    }

    public function actionItems()
    {
        if (!Session::check('admin')) {
            header("Location: /admin/login");
        }

        $data['title'] = 'Items page';
        $this->view->generate('admin_template.php', 'admin_items.php', $data);
    }

    public function actionControl()
    {
        if (!Session::check('admin')) {
            header("Location: /admin/login");
        }

        $data['title'] = 'Control page';
        $this->view->generate('admin_template.php', 'admin_control.php', $data);
    }

    public function actionInsert()
    {
        if (!isset($_POST['insert'])) {
            header("Location: /admin");
        }

        $this->categories->insertCategoryInfo();

        header("Location: /admin/categories");
    }

    public function actionDelete()
    {
        if (!isset($_POST['delete'])) {
            header("Location: /admin");
        }

        $this->categories->deleteCategoryInfo($_POST['delete']);

        header("Location: /admin/categories");
    }
}

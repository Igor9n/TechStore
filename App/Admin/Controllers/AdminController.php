<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 21.01.19
 * Time: 9:50
 */

namespace App\Admin\Controllers;

use App\Admin\Mappers\AdminMapper;
use App\Classes\Session;
use Core\Controller;
use App\Admin\Main\AdminView;
use Core\CustomRedirect;
use Core\Request;
use Core\Response;

class AdminController extends Controller
{
    public $categories;
    public $categoryCharacteristics;
    public $item;

    public function __construct()
    {
        parent::__construct();
        $this->view = new AdminView();
        $this->mapper = new AdminMapper();
        $this->categories = new CategoryController();
        $this->item = new ItemController();
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
        CustomRedirect::redirect('admin/login');
    }

    public function actionLogin(Request $request)
    {
        $action = $request->getPostParam('try');

        if ($action) {
            $data['errors'] = $this->try($action);
        }

        if (Session::check('admin')) {
            CustomRedirect::redirect('admin');
        }

        $data['title'] = 'Admin login';
        $this->view->render('admin_login', $data);
    }

    public function actionIndex()
    {
        if (!Session::check('admin')) {
            CustomRedirect::redirect('admin/login');
        }

        $data['title'] = 'Admin page';
        $this->view->render('admin_main', $data);
    }

    public function actionCategory($action)
    {
        if (!Session::check('admin')) {
            header("Location: /admin/login");
        }

        $id = 0;
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        $data['title'] = 'Categories characteristics';

        if ($action && isset($_POST[$action])) {
            $this->categoryCharacteristics->getErrors($action);
            $action = 'action' . ucfirst($action);
            $this->categoryCharacteristics->$action();
        } else {
            $data['info'] = $this->categoryCharacteristics->getCharacteristicsByCategory($id);
            $data['errors'] = Session::get('errors');
            Session::unset('errors');
        }

        $this->view->generate('admin_template.php', 'admin_category.php', $data);
    }

    public function actionItem($action)
    {
        if (!Session::check('admin')) {
            header("Location: /admin/login");
        }

        $id = 0;
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        if ($action) {
            $action = 'action' . ucfirst($action);
            $this->item->$action();
        }

        $data['item'] = $this->item->getItem($id);
        $data['categories'] = $this->categories->getCategories();
        $data['characteristics'] = $this->item->getCharacteristics($data['item']);
        $data['title'] = 'Item page';

        $this->view->generate('admin_template.php', 'admin_item.php', $data);
    }

    public function actionControl()
    {
        if (!Session::check('admin')) {
            header("Location: /admin/login");
        }

        $data['title'] = 'Control page';
        $this->view->generate('admin_template.php', 'admin_control.php', $data);
    }

    public function chooseController(Request $request)
    {
        if (!Session::check('admin')) {
            CustomRedirect::redirect('admin');
        }

        $key = $request->getActionKey();
        $controller = $this->mapper->chooseController($key);

        if (!$key && !$controller) {
            CustomRedirect::redirect('admin/main');
        }
        $action = $request->getActionName();
        $this->$controller->$action($request);
    }

    public function actionAll(Request $request)
    {
        $this->chooseController($request);
    }

    public function actionOne(Request $request)
    {
        $this->chooseController($request);
    }
}

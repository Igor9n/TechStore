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
use App\Admin\Main\MainView;
use Core\CustomRedirect;
use Core\Request;
use Core\Response;

class AdminController extends Controller
{
    public $categories;
    public $categoryCharacteristics;
    public $item;
    public $order;
    public $user;

    public function __construct()
    {
        parent::__construct();
        $this->view = new MainView();
        $this->mapper = new AdminMapper();
        $this->categories = new CategoryController();
        $this->item = new ItemController();
        $this->order = new OrderController();
        $this->user = new UserController();
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

    public function actionControl()
    {
        if (!Session::check('admin')) {
            CustomRedirect::redirect('admin');
        }

        $data['title'] = 'Control page';
        $this->view->render('admin_control', $data);
    }

    public function chooseController(Request $request)
    {
        if (!Session::check('admin')) {
            CustomRedirect::redirect('admin');
        }

        $key = $request->getActionKey();
        $controller = $this->mapper->chooseController($key);

        if (!$key || !$controller) {
            CustomRedirect::redirect('admin');
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

    public function actionUpdate(Request $request)
    {
        $this->chooseController($request);
    }

    public function actionDelete(Request $request)
    {
        $this->chooseController($request);
    }

    public function actionInsert(Request $request)
    {
        $this->chooseController($request);
    }
}

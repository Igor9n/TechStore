<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.01.19
 * Time: 20:32
 */

namespace App\User\Controllers;

use Core\Session;
use Core\Controller;
use App\User\Mappers\UserMapper;
use App\User\Models\OrderModel;
use Core\CustomRedirect;
use Core\Request;

class UserController extends Controller
{
    public $orderModel;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new UserMapper();
        $this->orderModel = new OrderModel();
    }

    /**
     * Trying to login/register
     *
     * @param string $action
     * @return string
     */
    public function try(string $action)
    {
        $method = $action . 'User';
        $errors = $action . 'Errors';

        $user = $this->mapper->getObject($action);
        $errors = $this->mapper->$errors($user, $action);

        if (empty($errors)) {
            $errors = $this->mapper->$method($user, $errors);
        }

        return $errors;
    }

    public function actionLogin(Request $request)
    {
        $action = $request->getPostParam('try');

        if ($action) {
            $data['errors'] = $this->try($action);
        }

        if (Session::check('user')) {
            CustomRedirect::redirect('order/all');
        }

        $data['title'] = 'Login';

        $this->view->initView('login', $data);
    }

    public function actionRegistration(Request $request)
    {
        $action = $request->getPostParam('try');

        if ($action) {
            $data['errors'] = $this->try($action);
        }

        if (Session::check('user')) {
            CustomRedirect::redirect('order/all');
        }

        $data['title'] = 'Registration';

        if (Session::check(REGISTERED)) {
            $data[REGISTERED] = Session::get(REGISTERED);
            Session::unset(REGISTERED);
        }

        $this->view->initView('registration', $data);
    }

    public function actionLogout()
    {
        Session::unset('user');
        CustomRedirect::redirect('user/login');
    }
}
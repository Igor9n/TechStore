<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.01.19
 * Time: 20:32
 */

namespace App\Controllers;

use App\Classes\Session;
use Core\Controller;
use App\Mappers\UserMapper;
use App\Models\{OrderModel};

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

    public function actionLogout()
    {
        Session::unset('user');
        header("Location: /user/login");
    }

    /**
     * Login page
     */
    public function actionLogin()
    {
        if (isset($_POST['try'])) {
            $data['errors'] = $this->try($_POST['try']);
        }

        if (Session::check('user')) {
            header("Location: /order/all");
        }

        $data['title'] = 'Login';

        $this->view->generate('template.php', 'login.php', $data);
    }

    /**
     * Registration page
     */
    public function actionRegistration()
    {
        if (isset($_POST['try'])) {
            $data['errors'] = $this->try($_POST['try']);
        }

        if (Session::check('user')) {
            header("Location: /order/all");
        }

        $data['title'] = 'Registration';

        if (Session::check('registered')) {
            $data['registered'] = Session::get('registered');
            Session::unset('registered');
        }

        $this->view->generate('template.php', 'registration.php', $data);
    }
}
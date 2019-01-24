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
     */
    public function actionTry(): void
    {
        if (!isset($_POST['try'])) {
            header("Location: /user/login");
        }

        Session::additionalSessionStart();

        $action = $_POST['try'];
        $method = $action . 'User';
        $errors = $action . 'Errors';

        $user = $this->mapper->getObject($action);
        $errors = $this->mapper->$errors($user, $action);

        $this->mapper->$method($user, $errors);
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
        if (Session::check('user')) {
            header("Location: /order/all");
        }

        $data['title'] = 'Login';
        $data['errors'] = Session::get('errors');
        Session::unset('errors');

        $this->view->generate('template.php', 'login.php', $data);
    }

    /**
     * Registration page
     */
    public function actionRegistration()
    {
        if (Session::check('user')) {
            header("Location: /order/all");
        }

        $data['title'] = 'Registration';

        $data['errors'] = Session::get('errors');
        Session::unset('errors');

        if (Session::check('registered')) {
            $data['registered'] = Session::get('registered');
            Session::unset('registered');
        }

        $this->view->generate('template.php', 'registration.php', $data);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.01.19
 * Time: 20:32
 */

namespace App\Controllers;


use App\Classes\Session;
use App\Core\Controller;
use App\Mappers\UserMapper;
use App\Models\{OrderModel,UserModel};

class UserController extends Controller
{
    public $orderModel;
    public function __construct()
    {
        parent::__construct();
        $this->mapper = new UserMapper();
        $this->orderModel = new OrderModel();
    }

    public function actionTry(): void
    {
        $user = null;
        $errors = [];

        if (isset($_POST['try'])) {
            $user = $this->mapper->getObject($_POST['try']);
            $errors = $this->mapper->checkForErrors($user, $_POST['try']);
        }

        switch ($_POST['try']) {
            case 'log':
                $this->mapper->loginUser($errors, $user);
                break;
            case 'reg':
                $this->mapper->registerUser($errors,$user);
                break;
            default:
                header("Location: /user/login");
        }
    }

    public function actionLogin()
    {
        if (isset($_SESSION['user'])) {
            header("Location: /user/orders");
        }

        $data['title'] = 'Login';

        if (isset($_SESSION['errors'])) {
            $data['errors'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        $this->view->generate('template.php', 'login.php', $data);
    }
    public function actionRegistration()
    {
        if (isset($_SESSION['user'])) {
            header("Location: /user/orders");
        }

        $data['title'] = 'Registration';

        if (isset($_SESSION['errors'])) {
            $data['errors'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
        if (isset($_SESSION['registered'])) {
            $data['registered'] = true;
            unset($_SESSION['registered']);
        }

        $this->view->generate('template.php', 'registration.php', $data);
    }
    public function actionLogout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header("Location: /user/login");
    }

    public function actionOrders()
    {
        if (isset($_SESSION['user'])) {
            $id = $_SESSION['user']->id;
            $data['title'] = 'Orders';
            $data['info'] = $this->orderModel->getOrdersByUserId($id);
            $this->view->generate('template.php','orders.php',$data);
        } else {
            header("Location: /user/login");
        }
    }
    public function actionOrder($id)
    {
        if(isset($_SESSION['user'])){
            $data['title'] = 'Order info';
            $data['orderNumber'] = $id;
            $data['info'] = $this->orderModel->getOrderInfoById($id);
            $this->view->generate('template.php','order.php',$data);
        } else {
            header("Location: /user/login");
        }
    }
}
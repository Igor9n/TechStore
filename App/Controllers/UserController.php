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

    public function actionTry() {
        if (isset($_POST['try'])) {
            switch ($_POST['try']) {
                case 'log':
                    $user = $this->mapper->getObject($_POST['try']);
                    $errors = $this->mapper->checkForErrors($user['info'], $_POST['try']);
                    var_dump($errors); die;
                    if (empty($errors)) {
                        Session::anotherSessionStart();
                        $_SESSION['user']['info'] = $user;
                        $_SESSION['user']['login'] = true;
                        header("Location: user/orders");
                    }
                    break;
                case 'reg':
                    break;
            }

        } else {
            header("Location: /user/login");
        }
    }
    public function actionLogin()
    {
        if (isset($_SESSION['user'])) {
            header("Location: /user/orders");
        } else {
            if (isset($_POST['log'])) {
                $array = $this->model->getInfoFromPost('log');
                $errors = $this->model->checkForErrors($array, 'log');
                if (!empty($errors)) {
                    $_POST['errors'] = $errors;
                    $this->actionLogging();
                } else {
                    $errors = $this->model->checkLoginInfo($array['login'], $array['password']);
                    if (!$errors) {
                        Session::anotherSessionStart();
                        $info = $this->model->checkLogin('id', $array['login']);
                        $_SESSION['user']['id'] = $info[0]['id'];
                        $_SESSION['user']['name'] = $info[0]['login'];
                        $_POST['logged'] = true;
                        $this->actionLogging();
                    } else {
                        $_POST['errors'] = $errors;
                        $this->actionLogging();
                    }
                }
            } else {

            }
        }
    }
    public function actionRegister()
    {
        if (isset($_POST['reg'])) {
            $array = $this->model->getInfoFromPost('reg');
            $errors = $this->model->checkForErrors($array,'reg');
            if (!empty($errors)) {
                $_POST['errors'] = $errors;
                $this->actionRegistration();
            } else {
                $errors = $this->model->checkLogin('reg',$array['login'], $array['email']);
                if (!$errors) {
                    $this->model->registerUser($array['login'], $array['password'], $array['email']);
                    $_POST['registered'] = true;
                    $this->actionRegistration();
                } else {
                    $_POST['errors'] = $errors;
                    $this->actionRegistration();
                }
            }
        } else {
            header("Location: /user/registration");
        }
    }
    public function actionLogging(){
        if (isset($_SESSION['user'])){
            header("Location: /user/orders");
        } else {
            $data['title'] = 'Login';
            if (isset($_POST['logged'])) {
                $data['logged'] = true;
                unset($_POST['logged']);
            }
            if (isset($_POST['errors'])) {
                $data['errors'] = $_POST['errors'];
                unset($_POST['errors']);
            }
            $this->view->generate('template.php', 'login.php', $data);
        }
    }
    public function actionRegistration(){
        $data['title'] = 'Registration';
        if (isset($_POST['registered'])){
            $data['registered'] = true;
            unset($_POST['registered']);
        }
        if (isset($_POST['errors'])){
            $data['errors'] = $_POST['errors'];
            unset($_POST['errors']);
        }
        $this->view->generate('template.php', 'registration.php', $data);
    }
    public function actionLogout(){
        if (isset($_SESSION['user'])){
            unset($_SESSION['user']);
            header("Location: /user/logging");
        } else {
            header("Location: /user/logging");
        }
    }
    public function actionOrders(){
        if(isset($_SESSION['user'])){
            $id = $_SESSION['user']['id'];
            $data['title'] = 'Orders';
            $data['info'] = $this->orderModel->getOrdersByUserId($id);
            $this->view->generate('template.php','orders.php',$data);
        } else {
            header("Location: /user/logging");
        }

    }
    public function actionOrder($id){
        if(isset($_SESSION['user'])){
            $data['title'] = 'Order info';
            $data['orderNumber'] = $id;
            $data['info'] = $this->orderModel->getOrderInfoById($id);
            $this->view->generate('template.php','order.php',$data);
        } else {
            header("Location: /user/logging");
        }

    }
}
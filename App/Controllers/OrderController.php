<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 17.01.19
 * Time: 22:47
 */

namespace App\Controllers;


use App\Classes\Session;
use Core\Controller;
use App\Mappers\OrderMapper;
use App\Mappers\UserMapper;

class OrderController extends Controller
{
    public $userMapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new OrderMapper();
        $this->userMapper = new UserMapper();
    }

    public function actionAll()
    {
        if (!Session::check('user')) {
            header("Location: /user/login");
        }

        $id = Session::get('user')->id;
        $this->userMapper->addOrdersInfo($_SESSION['user'], $this->mapper->getOrdersListForUser($id));

        $data['info'] = Session::get('user');
        $data['title'] = 'Orders';

        $this->view->generate('template.php', 'orders.php', $data);
    }

    public function actionView()
    {
        if (!Session::check('user')) {
            header("Location: /user/login");
        }

        $order = false;
        $data['title'] = 'Order info';
        $id = $_GET['id'];

        if (isset(Session::get('user')->orders[$id])) {
            $order = $this->mapper->getOrder($id);
        }

        if ($order) {
            $data['info'] = $order;
        }

        $this->view->generate('template.php', 'order.php', $data);
    }

    public function actionCheck()
    {
        $data['info'] = $this->mapper->getShortenOrder($_GET['id']);
        $data['orderId'] = $_GET['id'];

        $data['title'] = 'Order status';
        $this->view->generate('template.php', 'check.php', $data);
    }
}

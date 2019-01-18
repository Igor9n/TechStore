<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 17.01.19
 * Time: 22:47
 */

namespace App\Controllers;


use App\Core\Controller;
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
        if (!isset($_SESSION['user'])){
            header("Location: /user/login");
        }

        $id = $_SESSION['user']->id;
        $this->userMapper->addOrdersInfo($_SESSION['user'],$this->mapper->getOrdersListForUser($id));

        $data['info'] = $_SESSION['user'];
        $data['title'] = 'Orders';

        $this->view->generate('template.php','orders.php',$data);
    }
    public function actionView()
    {
        if (!isset($_SESSION['user'])){
            header("Location: /user/login");
        }

        $order = false;
        $data['title'] = 'Order info';

        if(isset($_GET['id']) && isset($_SESSION['user']->orders[$_GET['id']])){
            $order = $this->mapper->getOrder($_GET['id']);
        }

        if($order){
            $data['info'] = $order;
        }

        $this->view->generate('template.php','order.php',$data);
    }
    public function actionCheck()
    {
        if(isset($_GET['id'])){
            $data['info'] = $this->mapper->getShortenOrder($_GET['id']);
            $data['orderId'] = $_GET['id'];
        }
        $data['title'] = 'Order status';
        $this->view->generate('template.php','check.php', $data);
    }
}
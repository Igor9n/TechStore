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

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->mapper = new OrderMapper();
    }

    public function actionAll()
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
    public function actionView()
    {
        if (!isset($_SESSION['user'])){
            header("Location: /user/login");
        }
        $order = false;
        $data['title'] = 'Order info';
        if(isset($_GET['id'])){
            $order = $this->mapper->getOrder($_GET['id']);
        }

        if($order){
            $data['info'] = $order;
        }

        $this->view->generate('template.php','order.php',$data);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 17.01.19
 * Time: 22:47
 */

namespace App\User\Controllers;


use App\Classes\Session;
use Core\Controller;
use App\User\Mappers\OrderMapper;
use App\User\Mappers\UserMapper;
use Core\CustomRedirect;
use Core\Request;

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
            CustomRedirect::redirect('user/login');
        }

        $id = Session::get('user')->id;
        $this->userMapper->addOrdersInfo(Session::get('user'), $this->mapper->getOrdersListForUser($id));

        $data['info'] = Session::get('user');
        $data['title'] = 'Orders';

        $this->view->render('orders', $data);
    }

    public function actionView(Request $request)
    {
        if (!Session::check('user')) {
            CustomRedirect::redirect('user/login');
        }

        $order = false;
        $data['title'] = 'Order info';
        $id = $request->getParam('id');

        if (isset(Session::get('user')->orders[$id])) {
            $order = $this->mapper->getOrder($id);
        }

        if ($order) {
            $data['info'] = $order;
        }

        $this->view->render('order', $data);
    }

    public function actionCheck(Request $request)
    {
        $data['orderId'] = $request->getParam('id');

        $data['info'] = $this->mapper->getShortenOrder($data['orderId']);

        $data['title'] = 'Order status';
        $this->view->render('check', $data);
    }
}

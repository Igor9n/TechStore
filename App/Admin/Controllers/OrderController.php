<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 05.02.19
 * Time: 13:54
 */

namespace App\Admin\Controllers;

use App\Admin\Main\MainController;
use App\Admin\Mappers\OrderMapper;

class OrderController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->mapper = new OrderMapper();
    }

    public function actionAll()
    {
        $data['orders'] = $this->mapper->getAllOrders();
        $data['title'] = 'All orders';
        $data['errors'] = $this->getErrors();

        $this->view->render('admin_orders', $data);
    }
}

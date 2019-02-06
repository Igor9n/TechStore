<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 05.02.19
 * Time: 13:54
 */

namespace App\Admin\Controllers;

use App\Admin\Main\MainController;
use App\Admin\Mappers\ItemMapper;
use App\Admin\Mappers\OrderMapper;
use Core\CustomRedirect;
use Core\Request;

class OrderController extends MainController
{
    public $item;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new OrderMapper();
        $this->item = new ItemMapper();
    }

    public function actionDelete(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionUpdate(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionInsert(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionAll()
    {
        $data['orders'] = $this->mapper->getAllOrders();
        $data['title'] = 'All orders';
        $data['errors'] = $this->getErrors();

        $this->view->render('admin_orders', $data);
    }

    public function actionOne(Request $request)
    {
        $id = $request->getParam('id');

        if (!$this->mapper->checkExists($id)) {
            CustomRedirect::redirect('404');
        }

        $data['title'] = 'Order info';
        $data['order'] = $this->mapper->getOrder($id);
        $data['errors'] = $this->getErrors();
        $data['items'] = $this->item->getAllItems();

        $this->view->render('admin_order', $data);
    }
}


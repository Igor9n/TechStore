<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 05.02.19
 * Time: 14:02
 */

namespace App\Admin\Mappers;


use App\Admin\Data\Order;
use App\Admin\Main\MainMapper;
use App\Admin\Models\OrderModel;

class OrderMapper extends MainMapper
{
    public $user;

    public function __construct()
    {
        $this->model = new OrderModel();
        $this->mapper = new ItemMapper();
        $this->user = new UserMapper();
    }

    public function getObject($id, array $array): Order
    {
        return Order::getObject(
            $id,
            $array['main'],
            $array['personal'],
            $array['address'],
            $array['delivery'],
            $array['products']
        );
    }

    public function getAllOrders()
    {
        $array = [];
        $ordersList = $this->model->getOrdersIdList();
        foreach ($ordersList as $orderId) {
            $array[] = $this->getOrder($orderId);
        }
        return $array;
    }

    public function getOrdersListForUser($id)
    {
        $array = [];
        $list = $this->model->getOrdersIdByUserId($id);
        $status = $this->model->getOrdersStatusByUserId($id);
        $price = $this->model->getOrdersPriceByUserId($id);

        for ($i = 0; $i < count($list); $i++) {
            $array[$list[$i]]['id'] = $list[$i];
            $array[$list[$i]]['status'] = $status[$i];
            $array[$list[$i]]['totalPrice'] = $price[$i];
        }

        return $array;
    }

    public function getProductInfo(array $array, $order): array
    {

        foreach ($array as $product) {
            $info = $info = $this->model->getOrderProductInfo($product['info']->id, $order);

            $array[$product['info']->id]['count'] = $info['count'];
            $array[$product['info']->id]['endprice'] = $info['endprice'];
            $array[$product['info']->id]['rowID'] = $info['id'];
        }

        return $array;
    }

    public function getOrder($id)
    {
        $array = $this->getOrderInfo($id);

        return $this->getObject($id, $array);
    }

    public function getProductsForOrder($id): array
    {
        $products = [];
        $list = $this->model->getProductsListByOrderId($id);
        foreach ($list as $product) {
            $products[$product]['info'] = $this->mapper->getItemObject($product);
        }
        return $this->getProductInfo($products, $id);
    }

    public function getOrderInfo($id)
    {
        $array['main'] = $this->model->getMainOrderInfo($id);
        $array['personal'] = $this->model->getPersonalInfoByOrderId($id);
        $array['address'] = $this->model->getAddressInfoByOrderId($id);
        $array['delivery'] = $this->model->getDeliveryInfoByOrderId($id);
        $array['products'] = $this->getProductsForOrder($id);
        return $array;
    }

    public function checkExists($orderId)
    {
        $array = $this->model->getOrdersIdList();

        if (in_array($orderId, $array)) {
            return true;
        }
        return false;
    }

    public function checkForErrors()
    {
        return [];
    }

    public function updateOrderProduct($rowID, $count, $endprice)
    {
        return $this->model->updateOrderProductCount($rowID, $count, $endprice);
    }

    public function updateOrderStatus($order, $status)
    {
        return $this->model->updateOrderStatus($order, $status);
    }

    public function deleteOrderProduct($rowID)
    {
        return $this->model->deleteOrderProduct($rowID);
    }

    public function deleteOrder($id)
    {
        return [
            $this->model->deleteOrderProducts($id),
            $this->model->deleteOrderDelivery($id),
            $this->model->deleteOrder($id)
        ];
    }

    public function updateOrderTotalPrice($orderId)
    {
        $totalPrice = 0;
        $products = $this->getProductsForOrder($orderId);
        foreach ($products as $product) {
            $totalPrice += $product['endprice'];
        }
        return $this->model->updateOrderTotalPrice($orderId, $totalPrice);
    }

    public function delete(array $info)
    {
        $result = null;
        if ($info['what'] === 'order') {
            $result = $this->deleteOrder($info['id']);
        } elseif ($info['what'] === 'product') {
            $this->deleteOrderProduct($info['id']);
            $result = $this->updateOrderTotalPrice($info['order']);
        }
        return $result;
    }

    public function insert(array $info)
    {
        $product = explode('&', $info['product']);

        $this->model->insertOrderProduct($info['order'], $product[0], $product[1]);
        return $this->updateOrderTotalPrice($info['order']);
    }

    public function update(array $info)
    {
        $result = null;
        if ($info['what'] === 'status') {
            $result = $this->updateOrderStatus($info['id'], $info['status']);
        } elseif ($info['what'] === 'product') {
            $endprice = $info['count'] * $info['price'];
            $this->updateOrderProduct($info['id'], $info['count'], $endprice);
            return $this->updateOrderTotalPrice($info['order']);
        }
        return $result;
    }

}

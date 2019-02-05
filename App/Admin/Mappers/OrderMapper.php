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
    public function __construct()
    {
        $this->model = new OrderModel();
        $this->mapper = new ItemMapper();
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

    public function getProductsPriceInfo(array $array): array
    {
        foreach ($array as $product) {
            $array[$product['info']->id]['count'] = $this->model->getOrderProductCount($product['info']->id);
            $array[$product['info']->id]['endprice'] = $this->model->getOrderProductEndprice($product['info']->id);
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
        $list = $this->model->getProductsListByOrderId($id);
        foreach ($list as $product) {
            $products[$product]['info'] = $this->mapper->getItemObject($product);
        }
        return $this->getProductsPriceInfo($products);
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
}
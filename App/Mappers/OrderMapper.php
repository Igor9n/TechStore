<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 16.01.19
 * Time: 22:32
 */

namespace App\Mappers;


use Core\Mapper;
use App\Data\Order;
use App\Models\OrderModel;

class OrderMapper extends Mapper
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
            $array['personal'],
            $array['address'],
            $array['delivery'],
            $array['products']
        );
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
        $result = false;
        if ($this->model->checkOrderById($id)) {
            $array = $this->getOrderInfo($id);
            $result = $this->getObject($id, $array);
        }
        return $result;
    }

    public function getShortenOrder($id)
    {
        $array = [];
        if ($this->model->checkOrderById($id)) {
            $array['delivery'] = $this->model->getDeliveryInfoByOrderId($id);
            $array['status'] = $this->model->getOrderStatus($id);
        }
        return $array;
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
        $array['personal'] = $this->model->getPersonalInfoByOrderId($id);
        $array['address'] = $this->model->getAddressInfoByOrderId($id);
        $array['delivery'] = $this->model->getDeliveryInfoByOrderId($id);
        $array['products'] = $this->getProductsForOrder($id);
        return $array;
    }
}
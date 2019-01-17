<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 16.01.19
 * Time: 22:32
 */

namespace App\Mappers;


use App\Core\Mapper;
use App\Data\Order;
use App\Models\OrderModel;

class OrderMapper extends Mapper
{
    public function __construct()
    {
        $this->model = new OrderModel();
        $this->mapper = new ItemMapper();
    }

    public function getProductsForOrder($id)
    {
        $list = $this->model->getProductsListByOrderId($id);
        return $this->mapper->getArray($list);
    }

    public function getOrderInfo($id)
    {
        $array['personal'] = $this->model->getPersonalInfoByOrderId($id);
        $array['address'] = $this->model->getAddressInfoByOrderId($id);
        $array['delivery'] = $this->model->getDeliveryInfoByOrderId($id);
        $array['products'] = $this->getProductsForOrder($id);
        return $array;
    }

    public function getOrder($id)
    {
        if ($this->model->checkOrderById($id)) {
            $array = $this->getOrderInfo($id);
            return $this->getObject($id, $array);
        }
        return false;
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
}
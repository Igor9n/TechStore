<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 05.02.19
 * Time: 14:05
 */

namespace App\Admin\Models;

use Core\Model;

class OrderModel extends Model
{
    public $product;
    public $order;

    public function __construct()
    {
        parent::__construct();
        $this->product = "SELECT count, endprice FROM orders_products WHERE product_id = :product";
        $this->order = "
            SELECT orders.id,status,total_price FROM orders
            JOIN users_personal
            ON orders.personal_id = users_personal.id
            WHERE users_personal.user_id = :user";
    }

    public function getMainOrderInfo($id)
    {
        $query = "SELECT total_price, status FROM orders WHERE id = :id";
        return $this->queryRow($query, ['id' => $id]);
    }

    public function getOrdersIdList()
    {
        $query = "SELECT id FROM orders";
        return $this->queryList($query, 'id');
    }

    public function checkOrderById($id)
    {
        $result = false;
        $info = "SELECT COUNT(id) FROM orders WHERE orders.id = :order";
        if ($this->queryColumn($info, ['order' => $id], 0)) {
            $result = true;
        }
        return $result;
    }

    public function getOrdersIdByUserId($id)
    {
        return $this->queryList($this->order, 'id', ['user' => $id]);
    }

    public function getOrdersStatusByUserId($id)
    {
        return $this->queryList($this->order, 'status', ['user' => $id]);
    }

    public function getOrdersPriceByUserId($id)
    {
        return $this->queryList($this->order, 'total_price', ['user' => $id]);
    }

    public function getPersonalInfoByOrderId($id)
    {
        $array = [];
        $info = "
            SELECT first_name,last_name,phone_number,email,user_id 
            FROM users_personal
            JOIN orders
            ON users_personal.id = orders.personal_id
            WHERE orders.id = :order
        ";
        $result = $this->queryRow($info, ['order' => $id]);

        $array['firstName'] = $result['first_name'];
        $array['lastName'] = $result['last_name'];
        $array['phoneNumber'] = $result['phone_number'];
        $array['email'] = $result['email'];
        $array['user'] = $result['user_id'];

        return $array;
    }

    public function getAddressInfoByOrderId($id)
    {
        $array = [];
        $info = "
            SELECT city,address,apartments_numbers 
            FROM users_addresses
            JOIN orders
            ON users_addresses.personal_id = orders.personal_id
            WHERE orders.id = :order
        ";
        $result = $this->queryRow($info, ['order' => $id]);

        $array['city'] = $result['city'];
        $array['address'] = $result['address'];
        $array['apartmentsNumbers'] = $result['apartments_numbers'];

        return $array;
    }

    public function getDeliveryInfoByOrderId($id)
    {
        $array = [];
        $info = "
            SELECT type,date,time
            FROM orders_delivery
            JOIN orders
            ON orders_delivery.order_id = orders.id
            WHERE orders.id = :order
        ";
        $result = $this->queryRow($info, ['order' => $id]);

        $array['type'] = $result['type'];
        $array['date'] = $result['date'];
        $array['time'] = $result['time'];

        return $array;
    }

    public function getProductsListByOrderId($id)
    {
        $query = "
            SELECT product_id 
            FROM orders_products
            WHERE order_id = :order
        ";
        return $this->queryList($query, 'product_id', ['order' => $id]);
    }

    public function getOrderProductCount($id)
    {
        return $this->queryColumn($this->product, ['product' => $id], 'count');
    }

    public function getOrderProductEndprice($id)
    {
        return $this->queryColumn($this->product, ['product' => $id], 'endprice');
    }

    public function getOrderStatus($id)
    {
        $query = "SELECT status FROM orders WHERE id = :order";
        return $this->queryColumn($query, ['order' => $id], 'status');
    }

    public function updateOrderStatus($id, $status)
    {
        $query = "UPDATE orders 
                          SET status = :status, updated_at = NOW() 
                          WHERE id = :id";
        return $this->queryColumn($query, ['status' => $status, 'id' => $id]);
    }

    public function deleteOrderProducts($order)
    {
        $query = "DELETE FROM orders_products WHERE order_id = :order";
        return $this->queryColumn($query, ['order' => $order]);
    }

    public function deleteOrderDelivery($order)
    {
        $query = "DELETE FROM orders_delivery WHERE order_id = :order";
        return $this->queryColumn($query, ['order' => $order]);
    }

    public function deleteOrder($id)
    {
        $query = "DELETE FROM orders WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }
}

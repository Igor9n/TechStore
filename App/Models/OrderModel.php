<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 08.01.19
 * Time: 13:37
 */

namespace App\Models;


use App\Core\Model;

class OrderModel extends Model
{
    public $product;
    public function __construct()
    {
        parent::__construct();
        $this->product = "SELECT count, endprice FROM orders_products WHERE product_id = :product";
    }

    public function checkOrderById($id)
    {
        $info = "SELECT COUNT(id) FROM orders WHERE orders.id = :order";
        if ($this->queryOne($info, ['order' => $id], 0)){
            return true;
        };
        return false;
    }

    public function getOrdersByUserId($id)
    {
        $array = [];
        $i = 0;
        $orders = $this->pdo->prepare('SELECT id,status,total_price FROM orders WHERE user_id = ?');
        $orders->execute([$id]);
        while ($value = $orders->fetch()){
            $array[$i]['orderNumber'] = $value['id'];
            $array[$i]['orderStatus'] = $value['status'];
            $array[$i]['totalPrice'] = $value['total_price'];
            $i++;
        }
        return $array;
    }
    public function getPersonalInfoByOrderId($id)
    {
        $array = [];
        $info = "
            SELECT first_name,last_name,phone_number,email 
            FROM users_personal
            JOIN orders
            ON users_personal.id = orders.personal_id
            WHERE orders.id = :order
        ";
        $array['firstName'] = $this->queryOne($info,['order' => $id],0);
        $array['lastName'] = $this->queryOne($info,['order' => $id],1);
        $array['phoneNumber'] = $this->queryOne($info,['order' => $id],2);
        $array['email'] = $this->queryOne($info,['order' => $id],3);

        return $array;
    }
    public function getAddressInfoByOrderId($id)
    {
        $array = [];
        $info = "
            SELECT city,address,apartments_numbers 
            FROM users_addresses
            JOIN orders
            ON users_addresses.id = orders.personal_id
            WHERE orders.id = :order
        ";
        $array['city'] = $this->queryOne($info,['order' => $id],0);
        $array['address'] = $this->queryOne($info,['order' => $id],1);
        $array['apartmentsNumbers'] = $this->queryOne($info,['order' => $id],2);

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
        $array['type'] = $this->queryOne($info,['order' => $id],0);
        $array['date'] = $this->queryOne($info,['order' => $id],1);
        $array['time'] = $this->queryOne($info,['order' => $id],2);

        return $array;
    }
    public function getProductsListByOrderId($id)
    {
        $query = "
            SELECT product_id 
            FROM orders_products
            WHERE order_id = :order
        ";
        return $this->queryList($query,0,['order' => $id]);
    }
    public function getOrderProductCount($id)
    {
        return $this->queryOne($this->product,['product' => $id], 0);
    }
    public function getOrderProductEndprice($id)
    {
        return $this->queryOne($this->product,['product' => $id], 1);
    }
}
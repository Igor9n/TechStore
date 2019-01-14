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
    public function __construct()
    {
        parent::__construct();
    }
    public function getOrdersByUserId($id){
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
    public function getPersonalInfoByOrderId($id){
        $array = [];
        $info = $this->pdo->prepare(
            'SELECT first_name,last_name,phone_number,email 
            FROM users_personal
            JOIN orders
            ON users_personal.id = orders.personal_id
            WHERE orders.id = ?');
        $info->execute([$id]);
        while ($value = $info->fetch()){
            $array['firstName'] = $value['first_name'];
            $array['lastName'] = $value['last_name'];
            $array['phoneNumber'] = $value['phone_number'];
            $array['email'] = $value['email'];
        }
        return $array;
    }
    public function getAddressInfoByOrderId($id){
        $array = [];
        $info = $this->pdo->prepare(
            'SELECT city,address,apartments_numbers 
            FROM users_addresses
            JOIN orders
            ON users_addresses.id = orders.personal_id
            WHERE orders.id = ?');
        $info->execute([$id]);
        while ($value = $info->fetch()){
            $array['city'] = $value['city'];
            $array['address'] = $value['address'];
            $array['apartmentsNumbers'] = $value['apartments_numbers'];
        }
        return $array;
    }
    public function getDeliveryInfoByOrderId($id){
        $array = [];
        $info = $this->pdo->prepare(
            'SELECT type,date,time
            FROM orders_delivery
            JOIN orders
            ON orders_delivery.order_id = orders.id
            WHERE orders.id = ?');
        $info->execute([$id]);
        while ($value = $info->fetch()){
            $array['type'] = $value['type'];
            $array['date'] = $value['date'];
            $array['time'] = $value['time'];
        }
        return $array;
    }
    public function getProductsInfoByOrderId($id){
        $array = [];
        $info = $this->pdo->prepare(
            'SELECT title,service_title
            FROM products
            JOIN orders_products
            ON products.id = orders_products.product_id
            WHERE orders_products.order_id = ?');
        $info->execute([$id]);
        while ($value = $info->fetch()){
            $array[$value['service_title']]['id'] = $value['service_title'];
            $array[$value['service_title']]['name'] = $value['title'];
        }
        $info = $this->pdo->prepare(
            'SELECT `count`
            FROM orders_products
            JOIN products
            ON products.id = orders_products.product_id
            WHERE orders_products.order_id = ? AND products.service_title = ?');
        foreach ($array as $var){
            $info->execute([$id,$var['id']]);
            while ($value = $info->fetch()){
                $array[$var['id']]['count'] = $value['count'];
            }
        }
        $info = $this->pdo->prepare(
            'SELECT `price`
            FROM products_availability
            JOIN products
            ON products_availability.product_id = products.id
            WHERE products.service_title = ?');
        foreach ($array as $var){
            $info->execute([$var['id']]);
            while ($value = $info->fetch()){
                $array[$var['id']]['endprice'] = $var['count'] * $value['price'];
            }
        }
        return $array;
    }
    public function getOrderInfoById($id){
        $array = [];
        $array['personal'] = $this->getPersonalInfoByOrderId($id);
        $array['address'] = $this->getAddressInfoByOrderId($id);
        $array['delivery'] = $this->getDeliveryInfoByOrderId($id);
        $array['products'] = $this->getProductsInfoByOrderId($id);
        return $array;
    }
}
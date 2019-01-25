<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.01.19
 * Time: 20:31
 */

namespace App\Models;


use Core\Model;

class CartModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function submitPersonal($array)
    {
        $personal = "
            INSERT INTO users_personal (first_name,last_name,phone_number,email,user_id)
            VALUES (:first, :last, :phone, :email, :user)";
        $this->queryColumn($personal, [
            'first' => $array['firstName'],
            'last' => $array['lastName'],
            'phone' => $array['phone'],
            'email' => $array['email'],
            'user' => $array['user']
        ]);
        $personalId = "SELECT last_insert_id()";
        return $this->queryColumn($personalId, [], 0);
    }

    public function submitAddress($person, $array)
    {
        $address = "
            INSERT INTO users_addresses (city,address,apartments_numbers,zip,personal_id)
            VALUES (:city, :address, :apartments, :zip, :personalId)";
        $this->queryColumn($address, [
            'city' => $array['city'],
            'address' => $array['address'],
            'apartments' => $array['apartments'],
            'zip' => $array['zip'],
            'personalId' => $person
        ]);
    }

    public function submitOrder($person, $price)
    {
        $order = "
            INSERT INTO orders (personal_id,total_price)
            VALUES (:person, :price)";
        $this->queryColumn($order, [
            'person' => $person,
            'price' => $price
        ]);
        $orderId = "SELECT last_insert_id()";
        return $this->queryColumn($orderId, [], 0);
    }

    public function submitOrderDelivery($order)
    {
        $delivery = "INSERT INTO orders_delivery (order_id)
            VALUES (:order)";
        $this->queryColumn($delivery, ['order' => $order]);
    }

    public function submitOrderProducts($order, $array)
    {
        $orderProducts = "
            INSERT INTO orders_products (order_id,product_id, count, endprice)
            VALUES (:order, :product, :count, :price)";
        foreach ($array as $var) {
            $this->queryColumn($orderProducts, [
                'order' => $order,
                'product' => $var['info']->id,
                'count' => $var['count'],
                'price' => $var['endPrice']
            ]);
        }
    }
}
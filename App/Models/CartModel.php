<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.01.19
 * Time: 20:31
 */

namespace App\Models;


use App\Core\Model;

class CartModel extends Model
{
    public function __construct(){
        parent::__construct();
    }

    public function validateName($flag, $value){
        $errors = [];
        switch ($flag){
            case 'first':
                if(!preg_match('/^[A-Za-z]+$/',$value)){
                    $errors['firstSymbols'] = 'First name may contains only letters';
                }
                if(strlen($value) < 2 || strlen($value) > 12){
                    $errors['firstCount'] = 'First name may have min 2 and max 12 symbols';
                };
                return $errors;
            case 'last':
                if(!preg_match('/^[A-Za-z]+$/',$value)){
                    $errors['lastSymbols'] = 'Last name may contains only letters';
                }
                if(strlen($value) < 2 || strlen($value) > 20){
                    $errors['lastCount'] = 'Last name may have min 2 and max 20 symbols';
                }
                return $errors;
        }
        return $errors;
    }
    public function validatePhone($value){
        $errors = [];
        if(!preg_match('/^[0-9]+$/',$value)){
            $errors['phoneError'] = 'Phone may contains only numbers';
        }
        if(strlen($value) < 7 || strlen($value) > 12){
            $errors['phoneCount'] = 'Phone may have min 7 and max 12 numbers';
        };
        return $errors;
    }
    public function validateZip($value){
        $errors = [];
        if(!preg_match('/^[0-9]+$/',$value)){
            $errors['zipError'] = 'ZIP may contains only numbers';
        }
        if(strlen($value) < 1 || strlen($value) > 12){
            $errors['zipCount'] = 'ZIP may have min 1 and max 10 numbers';
        };
        return $errors;
    }
    public function validateEmail($value){
        $errors = [];
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
            $errors['emailError'] = 'Enter correct email';
        }
        return $errors;
    }
    public function validateCity($value){
        $errors = [];
        if(!preg_match('/^[A-Za-z\\-]+$/',$value)){
            $errors['cityError'] = 'Invalid city info';
        }
        if(strlen($value) < 2 || strlen($value) > 20){
            $errors['cityCount'] = 'City name may have min 2 and max 20 letters';
        }
        return $errors;

    }
    public function validateAddress($value){
        $errors = [];
        if(!preg_match('/^[A-Za-z0-9\\-. ]+$/',$value)){
            $errors['addressError'] = 'Invalid address info';
        }
        if(strlen($value) < 1 || strlen($value) > 30){
            $errors['addressCount'] = 'Address info may have min 1 and max 30 chars';
        }
        return $errors;
    }
    public function validateApartments($value){
        $errors = [];
        if(!preg_match('/^[A-Za-z0-9\\-]+$/',$value)){
            $errors['apartsError'] = 'Invalid apartments info';
        }
        if(strlen($value) < 1 || strlen($value) > 10){
            $errors['apartsCount'] = 'Apartments info may have min 1 and max 10 chars';
        }
        return $errors;
    }

    public function submitPersonal($array) {
        $personal = "
            INSERT INTO users_personal (first_name,last_name,phone_number,email)
            VALUES (:first, :last, :phone, :email)";
        $this->queryOne($personal, [
            'first' => $array['firstName'],
            'last' => $array['lastName'],
            'phone' => $array['phone'],
            'email' => $array['email'],
        ]);
        $personalId = "SELECT last_insert_id()";
        return $this->queryOne($personalId, [], 0);
    }
    public function submitAddress($person, $array) {
        $address = "
            INSERT INTO users_addresses (city,address,apartments_numbers,zip,personal_id)
            VALUES (:city, :address, :apartments, :zip, :personalId)";
        $this->queryOne($address, [
            'city' => $array['city'],
            'address' => $array['address'],
            'apartments' => $array['apartments'],
            'zip' => $array['zip'],
            'personalId' => $person
        ]);
    }
    public function submitOrder($person, $price){
        $order = "
            INSERT INTO orders (personal_id,total_price)
            VALUES (:person, :price)";
        $this->queryOne($order, [
            'person' => $person,
            'price' => $price
        ]);
        $orderId = "SELECT last_insert_id()";
        return $this->queryOne($orderId, [], 0);
    }
    public function submitOrderDelivery($order) {
        $delivery = "INSERT INTO orders_delivery (order_id)
            VALUES (:order)";
        $this->queryOne($delivery, ['order' => $order]);
    }
    public function submitOrderProducts($order, $array) {
        $orderProducts = "
            INSERT INTO orders_products (order_id,product_id, count, endprice)
            VALUES (:order, :product, :count, :price)";
        foreach ($array as $var){
            $this->queryOne($orderProducts, [
                'order' => $order,
                'product' => $var['info']->id,
                'count' => $var['count'],
                'price' => $var['endPrice']
            ]);
        }
    }
}
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
    public function getPersonalForOrder(){
        $array = [];
        if (!empty($_POST['email'])){
            $array['email'] = $_POST ['email'];
        }
        $array['firstName'] = $_POST['firstName'];
        $array['lastName'] = $_POST['lastName'];
        $array['phone'] = $_POST['phone'];
        return $array;

    }
    public function getAddressForOrder(){
        $array = [];
        if (!empty($_POST['zip'])){
            $array['zip'] = $_POST['zip'];
        }
        $array['city'] = $_POST['city'];
        $array['address'] = $_POST['address'];
        if (!empty($_POST['apartment'])) {
            $array['apartmentsNumbers'] = $_POST['house'] . '-' . $_POST['apartment'];
        } else {
            $array['apartmentsNumbers'] = $_POST['house'];
        }
        return $array;
    }
    public function getProductsInfo(){
        $array = [];
        foreach ($_SESSION['cart'] as $value){
            $array[$value['serviceTitle']]['id'] = $value['id'];
            $array[$value['serviceTitle']]['serviceTitle'] = $value['serviceTitle'];
            $array[$value['serviceTitle']]['count'] = $value['count'];
        }
        return $array;
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
            $errors['phoneError'] = 'Phone may contains only letters';
        }
        if(strlen($value) < 7 || strlen($value) > 12){
            $errors['firstCount'] = 'Phone may have min 7 and max 12 numbers';
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
    public function checkForErrors($array){
        $errors = [];
        $check['firstNameErrors'] = $this->validateName('first',$array['personal']['firstName']);
        $check['lastNameErrors'] = $this->validateName('last',$array['personal']['lastName']);
        $check['phoneErrors'] = $this->validatePhone($array['personal']['phone']);
        if(isset($array['personal']['email'])){
            $check['emailErrors'] = $this->validateEmail($array['personal']['email']);
        }
        $check['cityErrors'] = $this->validateCity($array['address']['city']);
        $check['addressErrors'] = $this->validateAddress($array['address']['address']);
        foreach ($check as $value){
            if (isset($value)){
                foreach ($value as $var){
                    $errors[] = $var;
                }
            }
        }
        return $errors;
    }
    public function getTotalPrice($array){
        $totalPrice = 0;
        $price = $this->pdo->prepare(
            'SELECT price FROM products_availability 
            JOIN products
            ON products.id = products_availability.product_id
            WHERE products.service_title = ?');
        foreach ($array['products'] as $var){
            $price->execute([$var['serviceTitle']]);
            $priceForAdd = $price->fetchColumn();
            $totalPrice = $totalPrice + $priceForAdd * $var['count'];
        }
        echo $totalPrice;
        die();
        return $totalPrice;
    }
    public function submitOrder($array){
        if(!isset($array['personal']['email'])) {
            $array['personal']['email'] = '';
        }
        $personal = $this->pdo->prepare(
            'INSERT INTO users_personal (first_name,last_name,phone_number,email)
            VALUES (?, ?, ?, ?)');
        $personal->execute([
            $array['personal']['firstName'],
            $array['personal']['lastName'],
            $array['personal']['phone'],
            $array['personal']['email']
        ]);
        $personalId = $this->pdo->query('SELECT last_insert_id()');
        $personalId = $personalId->fetchColumn();
        if(!isset($array['address']['zip'])) {
            $array['address']['zip'] = '';
        }
        $address = $this->pdo->prepare(
            'INSERT INTO users_addresses (city,address,apartments_numbers,zip,personal_id)
            VALUES (?, ?, ?, ?, ?)');
        $address->execute([
            $array['address']['city'],
            $array['address']['address'],
            $array['address']['apartmentsNumbers'],
            $array['address']['zip'],
            $personalId
        ]);
        $totalPrice = $this->getTotalPrice($array);
        $order = $this->pdo->prepare(
            'INSERT INTO orders (personal_id,total_price)
            VALUES (?, ?)');
        $order->execute([
            $personalId,
            $totalPrice
        ]);
        $orderId = $this->pdo->query('SELECT last_insert_id()');
        $orderId = $orderId->fetchColumn();
        $address = $this->pdo->prepare(
            'INSERT INTO orders_delivery (order_id)
            VALUES (?)');
        $address->execute([
            $orderId
        ]);
        $orderProducts = $this->pdo->prepare(
            'INSERT INTO orders_products (order_id,product_id, count)
            VALUES (?, ?, ?)');
        foreach ($array['products'] as $var){
            $orderProducts->execute([
                $orderId,
                $var['id'],
                $var['count']
            ]);
        }
        return $orderId;
    }
}
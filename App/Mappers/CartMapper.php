<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 14.01.19
 * Time: 17:07
 */

namespace App\Mappers;

use Core\Mapper;
use App\Data\Cart;
use App\Models\CartModel;

class CartMapper extends Mapper
{
    public function __construct()
    {
        $this->model = new CartModel();
    }

    public function getObject($item): Cart
    {
        return Cart::createObject($item);
    }

    public function changeItemCount($flag, Cart $object, $item)
    {
        $object->changeItemCount($flag, $item);
    }

    public function addItemToCart(Cart $object, $item)
    {
        $object->calculateItemEndPrice($item);
        $object->totalPrice = $object->getTotalPrice($object->itemsArray);
    }

    public function addPersonalInfo(Cart $object, $array)
    {
        $object->fillPersonalInfo(
            $array['firstName'],
            $array['lastName'],
            $array['phone'],
            $array['email'],
            $array['userId']
        );
    }

    public function addAddressInfo(Cart $object, $array)
    {
        $object->fillAddressInfo(
            $array['city'],
            $array['address'],
            $array['house'],
            $array['apartment'],
            $array['zip']
        );
    }

    public function checkForPersonalErrors($array)
    {
        $check['firstNameErrors'] = $this->model->validateName('first', $array['firstName']);
        $check['lastNameErrors'] = $this->model->validateName('last', $array['lastName']);
        $check['phoneErrors'] = $this->model->validatePhone($array['phone']);
        if (!empty($array['email'])) {
            $check['emailErrors'] = $this->model->validateEmail($array['email']);
        }
        return $this->makeSimpleArray($check);
    }

    public function checkForAddressErrors($array)
    {
        $check['cityErrors'] = $this->model->validateCity($array['city']);
        $check['addressErrors'] = $this->model->validateAddress($array['address']);
        $check['apartmentsErrors'] = $this->model->validateApartments($array['apartments']);
        if (!empty($array['zip'])) {
            $check['zipErrors'] = $this->model->validateZip($array['zip']);
        }
        return $this->makeSimpleArray($check);
    }

    public function checkForErrors(Cart $cart)
    {
        $check[] = $this->checkForPersonalErrors($cart->personalArray);
        $check[] = $this->checkForAddressErrors($cart->addressArray);
        return $this->makeSimpleArray($check);
    }

    public function submitOrder(Cart $object)
    {
        $personalSubmit = $this->model->submitPersonal($object->personalArray);
        $this->model->submitAddress($personalSubmit, $object->addressArray);
        $orderSubmit = $this->model->submitOrder($personalSubmit, $object->totalPrice);
        $this->model->submitOrderDelivery($orderSubmit);
        $this->model->submitOrderProducts($orderSubmit, $object->itemsArray);
        return $orderSubmit;
    }

    public function addInfoForOrder($cart)
    {
        $this->addAddressInfo($cart, [
            'city' => $_POST['city'],
            'address' => $_POST['address'],
            'house' => $_POST['house'],
            'apartment' => $_POST['apartment'],
            'zip' => $_POST['zip']
        ]);
        if (isset($_SESSION['user'])) {
            $id = (int)$_SESSION['user']->id;
        } else {
            $id = 0;
        }
        $this->addPersonalInfo($cart, [
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'userId' => $id
        ]);
    }
}
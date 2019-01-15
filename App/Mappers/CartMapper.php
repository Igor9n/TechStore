<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 14.01.19
 * Time: 17:07
 */

namespace App\Mappers;

use App\Core\Mapper;
use App\Data\Cart;
use App\Models\CartModel;

class CartMapper extends Mapper
{
    public function __construct() {
        $this->model = new CartModel();
    }

    public function getObject($item): Cart {
        return Cart::createObject($item);
    }

    public function changeItemCount($flag, $object, $item) {
        var_dump($object);
        $object->changeItemCount($flag ,$item);
    }

    public function addItemToCart($object, $item) {
        $object->calculateItemEndPrice($item);
        $object->totalPrice = $object->getTotalPrice($object->itemsArray);
    }

    public function addPersonalInfo($object, $array) {
        $object->fillPersonalInfo(
            $array[0],
            $array[1],
            $array[2],
            $array[3]
        );
    }

    public function addAddressInfo($object, $array) {
        $object->fillAddressInfo(
            $array[0],
            $array[1],
            $array[2],
            $array[3],
            $array[4]
        );
    }
}
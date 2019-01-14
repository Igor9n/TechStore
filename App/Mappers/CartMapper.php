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

    public function getObject(): Cart {
        return Cart::createObject(
            $_SESSION['cart']
        );
    }

    public function editObject() {

    }
}
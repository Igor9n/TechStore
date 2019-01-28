<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 17.01.19
 * Time: 22:08
 */

namespace App\User\Data;


class Order
{
    public $id;
    public $personalInfo;
    public $addressInfo;
    public $deliveryInfo;
    public $productsInfo;

    public function __construct($id, array $personal, array $address, array $delivery, array $products)
    {
        $this->id = $id;
        $this->personalInfo = $personal;
        $this->addressInfo = $address;
        $this->deliveryInfo = $delivery;
        $this->productsInfo = $products;
    }

    public static function getObject($id, $personal, $address, $delivery, $products): Order
    {
        return new self($id, $personal, $address, $delivery, $products);
    }
}

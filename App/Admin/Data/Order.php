<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 05.02.19
 * Time: 14:02
 */

namespace App\Admin\Data;


class Order
{
    public $id;
    public $mainInfo;
    public $personalInfo;
    public $addressInfo;
    public $deliveryInfo;
    public $productsInfo;

    protected function __construct($id, array $main, array $personal, array $address, array $delivery, array $products)
    {
        $this->id = $id;
        $this->mainInfo = $main;
        $this->personalInfo = $personal;
        $this->addressInfo = $address;
        $this->deliveryInfo = $delivery;
        $this->productsInfo = $products;
    }

    public static function getObject($id, $main, $personal, $address, $delivery, $products): Order
    {
        return new self($id, $main, $personal, $address, $delivery, $products);
    }
}

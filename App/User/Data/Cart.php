<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 14.01.19
 * Time: 17:11
 */

namespace App\User\Data;


class Cart
{
    public $itemsArray;
    public $personalArray;
    public $addressArray;
    public $totalPrice;

    public function __construct($item)
    {
        $this->addItem($item);
    }

    public static function createObject($item): Cart
    {
        return new self(
            $item
        );
    }

    public function changeItemCount($flag, $item)
    {
        if ($flag === 'plus') {
            $this->itemsArray[$item->id]['count']++;
        } else {
            $this->itemsArray[$item->id]['count']--;
        }
        $this->calculateItemEndPrice($item, $this->itemsArray[$item->id]['count']);
        $this->totalPrice = $this->getTotalPrice($this->itemsArray);
    }

    public function calculateItemEndPrice($item, $count = 1)
    {
        $this->itemsArray[$item->id]['info'] = $item;
        $this->itemsArray[$item->id]['count'] = $count;
        $this->itemsArray[$item->id]['endPrice'] = $this->itemsArray[$item->id]['count'] * $item->price;
    }

    public function addItem($item)
    {
        $this->calculateItemEndPrice($item);
        $this->totalPrice = $this->getTotalPrice($this->itemsArray);
    }

    public function endPrice($productsList)
    {
        foreach ($productsList as $item) {
            $productsList[$item['info']->serviceTitle]['endPrice'] = $item['info']->price * $item['count'];
        }
        return $productsList;
    }

    public function getTotalPrice($productsList)
    {
        $total = 0;
        foreach ($productsList as $item) {
            $total += $item['endPrice'];
        }
        return $total;
    }

    public function fillPersonalInfo($firstName, $lastName, $phone, $email = '', $id = '')
    {
        $this->personalArray['firstName'] = $firstName;
        $this->personalArray['lastName'] = $lastName;
        $this->personalArray['phone'] = $phone;
        $this->personalArray['email'] = $email;
        $this->personalArray['user'] = $id;
    }

    public function fillAddressInfo($city, $address, $house, $apartment = '', $zip = '')
    {
        $this->addressArray['city'] = $city;
        $this->addressArray['address'] = $address;
        $this->addressArray['apartments'] = $house;
        $this->addressArray['zip'] = $zip;

        if (!empty($apartment)) {
            $this->addressArray['apartments'] .= '-' . $apartment;
        }
    }
}
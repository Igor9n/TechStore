<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 14.01.19
 * Time: 17:11
 */

namespace App\Data;


class Cart
{
    public $itemsArray;
    public $personalArray;
    public $addressArray;
    public $totalPrice;

    public function __construct(array $itemsArray) {
        $this->itemsArray = $this->calculateItemsEndPrice($itemsArray);
        $this->totalPrice = $this->getTotalPrice($this->itemsArray);
    }

    public static function createObject(array $array): Cart {
        return new self(
            $array
        );
    }

    public function changeItemCount($flag, $item) {
        switch ($flag) {
            case "plus":
                $this->itemsArray[$item->serviceTitle]['count']++;
                break;
            case "minus":
                $this->itemsArray[$item->serviceTitle]['count']--;
                break;
        }
    }

    public function calculateItemsEndPrice($array) {
        foreach ($array as $item) {
            $array[$item['info']->serviceTitle]['endPrice'] = $item['info']->price * $item['count'];
        }
        return $array;
    }

    public function endPrice($arr) {
        foreach ($arr as $item) {
            $arr[$item['info']->serviceTitle]['endPrice'] = $item['info']->price * $item['count'];
        }
        return $arr;
    }

    public function getTotalPrice($array) {
        $total = 0;
        foreach ($array as $item) {
            $total += $item['endPrice'];
        }
        return $total;
    }

    public function fillPersonalInfo($firstName, $lastName, $phone, $email = '') {
        $this->personalArray['firstName'] = $firstName;
        $this->personalArray['lastName'] = $lastName;
        $this->personalArray['phone'] = $phone;
        $this->personalArray['email'] = $email;
    }

    public function fillAddressInfo($city, $address, $house, $apartment, $zip = '') {
        $this->addressArray['city'] = $city;
        $this->addressArray['address'] = $address;
        $this->addressArray['house'] = $house;
        $this->addressArray['apartment'] = $apartment;
        $this->addressArray['zip'] = $zip;
    }
}
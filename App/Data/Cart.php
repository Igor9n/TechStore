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

    public function __construct($item)
    {
        $this->calculateItemEndPrice($item);
        $this->totalPrice = $this->getTotalPrice($this->itemsArray);
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

    public function endPrice($arr)
    {
        foreach ($arr as $item) {
            $arr[$item['info']->serviceTitle]['endPrice'] = $item['info']->price * $item['count'];
        }
        return $arr;
    }

    public function getTotalPrice($array)
    {
        $total = 0;
        foreach ($array as $item) {
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
        if (!empty($apartment)) {
            $this->addressArray['apartments'] = $house . '-' . $apartment;
        } else {
            $this->addressArray['apartments'] = $house;
        }
        $this->addressArray['zip'] = $zip;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 07.02.19
 * Time: 14:41
 */

namespace App\Admin\Data;


class Personal
{
    public $id;
    public $first;
    public $last;
    public $phone;
    public $email;
    public $userId;
    public $userLogin;
    public $addressId;
    public $city;
    public $address;
    public $apartments;
    public $zip;
    public $order;

    protected function __construct(array $personal, array $user, array $address, $order)
    {
        {
            $this->id = $personal['id'];
            $this->first = $personal['first_name'];
            $this->last = $personal['last_name'];
            $this->phone = $personal['phone_number'];
            $this->email = $personal['email'];
        }
        {
            $this->userId = $user['id'];
            $this->userLogin = $user['login'];
        }
        {
            $this->addressId = $address['id'];
            $this->city = $address['city'];
            $this->address = $address['address'];
            $this->apartments = $address['apartments_numbers'];
            $this->zip = $address['zip'];
        }
        $this->order = $order;
    }

    public static function getObject(array $info, $order): Personal
    {
        return new self($info['personal'], $info['user'], $info['address'], $order);
    }

}
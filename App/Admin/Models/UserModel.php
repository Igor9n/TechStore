<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.02.19
 * Time: 13:24
 */

namespace App\Admin\Models;

use Core\Model;

class UserModel extends Model
{
    public function updatePersonalInfo($id, $first, $last, $phone, $email)
    {
        $query = "UPDATE users_personal 
                          SET first_name = :first, last_name = :last, phone_number = :phone, email = :email, updated_at = NOW() 
                          WHERE id = :id";
        return $this->queryColumn($query, [
            'id' => $id, 'first' => $first, 'last' => $last, 'phone' => $phone, 'email' => $email
        ]);
    }

    public function updateAddressInfo($id, $city, $address, $apartments, $zip)
    {
        $query = "UPDATE users_addresses 
                          SET city = :city, address = :address, apartments_numbers = :apartments, zip = :zip, updated_at = NOW() 
                          WHERE id = :id";
        return $this->queryColumn($query, [
            'id' => $id, 'city' => $city, 'address' => $address, 'apartments' => $apartments, 'zip' => $zip
        ]);
    }
}

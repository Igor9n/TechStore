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

    public function getUsersIDList()
    {
        $query = " SELECT id FROM users";
        return $this->queryList($query, 'id');
    }

    public function getPersonalIdList()
    {
        $query = " SELECT id FROM users_personal";
        return $this->queryList($query, 'id');
    }

    public function getPersonalIdListByUser($id)
    {
        $query = " SELECT id FROM users_personal WHERE user_id = :id";
        return $this->queryList($query, 'id', ['id' => $id]);
    }

    public function getFullPersonalInfo($id)
    {
        $query = "SELECT id, first_name, last_name, phone_number, email, user_id FROM users_personal WHERE id = :id";
        return $this->queryRow($query, ['id' => $id]);
    }

    public function getFullUserInfo($id)
    {
        $query = "SELECT id, login, email FROM users WHERE id = :id";
        return $this->queryRow($query, ['id' => $id]);
    }

    public function getFullAddressInfo($id)
    {
        $query = "SELECT id, city, address, apartments_numbers, zip, personal_id FROM users_addresses WHERE personal_id = :id";
        return $this->queryRow($query, ['id' => $id]);
    }

    public function getPersonalOrderId($id)
    {
        $result = false;
        $query = "SELECT id FROM orders WHERE personal_id = :id LIMIT 1";
        $order = $this->queryColumn($query, ['id' => $id], 0);

        if ($order) {
            $result = $order;
        }
        return $result;
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }

    public function deletePersonal($id)
    {
        $query = "DELETE FROM users_personal WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }

    public function deleteAddress($id)
    {
        $query = "DELETE FROM users_addresses WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }

    public function updateUserEmail($id, $email)
    {
        $query = "UPDATE users 
                          SET email = :email,  updated_at = NOW() 
                          WHERE id = :id";
        return $this->queryColumn($query, [
            'id' => $id,
            'email' => $email
        ]);
    }

    public function updatePersonalUserID($id, $user)
    {
        $query = "UPDATE users_personal
                          SET user_id = :user,  updated_at = NOW() 
                          WHERE id = :id";
        return $this->queryColumn($query, [
            'id' => $id,
            'user' => $user
        ]);
    }
}

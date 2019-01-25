<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 25.01.19
 * Time: 16:07
 */

namespace App\Admin\Models;


use Core\Model;

class ItemModel extends Model
{
    public function updateProductInfo($id, $title, $serviceTitle, $warranty, $short, $description, $category, $price)
    {
        $query = "UPDATE products 
                           SET title = :title, service_title = :service,
                                    warranty = :warranty ,short_description = :short, 
                                    description = :description,category_id = :category,
                                    price = :price,updated_at = NOW() 
                            WHERE id = :id";
        return $this->queryColumn($query, [
            'title' => $title,
            'service' => $serviceTitle,
            'warranty' => $warranty,
            'short_description' => $short,
            'description' => $description,
            'category_id' => $category,
            'price' => $price,
            'id' => $id
        ]);
    }

    public function updateProductCharacteristicValue($id, $value)
    {
        $query = "UPDATE products_characteristics
                           SET value = :value 
                           WHERE id = :id";
        return $this->queryColumn($query, ['value' => $value, 'id' => $id]);
    }

    public function insertProductInfo($title, $serviceTitle, $warranty, $short, $description, $category, $price)
    {
        $query = "INSERT INTO products (title, service_title, warranty,short_description,description,category_id,price) 
                          VALUES ( :title, :service, :warranty, :short, :description, :category, :price)";
        return $this->queryColumn($query, [
            'title' => $title,
            'service' => $serviceTitle,
            'warranty' => $warranty,
            'short_description' => $short,
            'description' => $description,
            'category_id' => $category,
            'price' => $price
        ]);
    }

    public function deleteProductCharacteristic($id)
    {
        $query = "DELETE FROM products_characteristics WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }

    public function deleteProductInfo($id)
    {
        $query = "DELETE FROM products WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }

    public function deleteProductCharacteristicValue($id)
    {
        $query = "UPDATE products_characteristics SET value = 'No info' WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }

    public function hideProduct($id)
    {
        $query = "UPDATE products SET visible = 'false' WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }

    public function showProduct($id)
    {
        $query = "UPDATE products SET visible = 'true' WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }
}

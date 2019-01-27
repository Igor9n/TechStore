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
    public function getProductsList()
    {
        $query = "SELECT id FROM products";
        return $this->queryList($query, 'id');
    }

    public function getFullProductInfo(int $id)
    {
        $query = "SELECT id, title, service_title, warranty, short_description, description, category_id, price, visible 
                          FROM products WHERE id = :id";
        return $this->queryRow($query, ['id' => $id]);
    }

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

    public function insertProductInfo(
        $title, $serviceTitle, $warranty, $price, $category, $short, $description, $visible
    ) {
        $query = "INSERT INTO products (title, service_title, warranty,short_description,description,category_id,price, visible) 
                          VALUES ( :title, :service, :warranty, :short, :description, :category, :price, :visible)";
        return $this->queryColumn($query, [
            'title' => $title,
            'service' => $serviceTitle,
            'warranty' => $warranty,
            'short' => $short,
            'description' => $description,
            'category' => $category,
            'price' => $price,
            'visible' => $visible
        ]);
    }

    public function deleteProductsCharacteristics($id)
    {
        $query = "DELETE FROM products_characteristics WHERE product_id = :id";
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

    public function checkItemUsage($id)
    {
        $result = false;
        $query = "SELECT order_id FROM orders_products WHERE product_id = :id LIMIT 1";
        if ($this->queryColumn($query, ['id' => $id], 0)) {
            $result = true;
        }
        return $result;
    }
}

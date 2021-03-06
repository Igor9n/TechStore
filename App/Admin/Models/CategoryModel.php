<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 25.01.19
 * Time: 15:21
 */

namespace App\Admin\Models;


use Core\Model;

class CategoryModel extends Model
{
    public function getCategoriesList()
    {
        $query = "SELECT id FROM categories";
        return $this->queryList($query, 'id');
    }

    public function getCharacteristicsListByCategory(int $id)
    {
        $query = "SELECT id FROM categories_characteristics WHERE category_id = :category";
        return $this->queryList($query, 'id', ['category' => $id]);
    }

    public function getFullCategoryInfo($id)
    {
        $query = "SELECT id, title, service_title FROM categories WHERE %s = :value";
        return $this->selectTypeAndQuery($query, $id, 'row');
    }

    public function getFullCategoryCharacteristicInfo($id)
    {
        $query = "SELECT id, title, category_id FROM categories_characteristics WHERE id = :id";
        return $this->queryRow($query, ['id' => $id]);
    }

    public function updateCategoryInfo($title, $serviceTitle, $id)
    {
        $query = "UPDATE categories SET title = :title, service_title = :service, updated_at = NOW() WHERE id = :id";
        return $this->queryColumn($query, ['title' => $title, 'service' => $serviceTitle, 'id' => $id]);
    }

    public function updateCategoryCharacteristic($id, $title)
    {
        $query = "UPDATE categories_characteristics SET title = :title, updated_at = NOW() WHERE id = :id";
        return $this->queryColumn($query, ['title' => $title, 'id' => $id]);
    }

    public function insertCategoryInfo($title, $serviceTitle)
    {
        $query = "INSERT INTO categories (title, service_title) VALUES (:title, :service)";
        return $this->queryColumn($query, ['title' => $title, 'service' => $serviceTitle]);
    }

    public function insertCategoryCharacteristic($title, $category)
    {
        $query = "INSERT INTO categories_characteristics (title, category_id) VALUES (:title, :category)";
        return $this->queryColumn($query, ['title' => $title, 'category' => $category]);
    }

    public function deleteCategoryInfo($id)
    {
        $query = "DELETE FROM categories WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }

    public function deleteCategoryCharacteristic($id)
    {
        $query = "DELETE FROM categories_characteristics WHERE id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }

    public function deleteCategoryCharacteristicsByCategory($id)
    {
        $query = "DELETE FROM categories_characteristics WHERE category_id = :id";
        return $this->queryColumn($query, ['id' => $id]);
    }

    public function checkCategoryProducts($id)
    {
        $result = false;
        $query = "SELECT service_title FROM products WHERE category_id = :id LIMIT 1";
        if ($this->queryColumn($query, ['id' => $id], 0)) {
            $result = true;
        }
        return $result;
    }

    public function checkCategoryCharacteristics($id)
    {
        $result = false;
        $query = "SELECT product_id FROM products_characteristics WHERE characteristic_id = :id LIMIT 1";
        if ($this->queryColumn($query, ['id' => $id], 0)) {
            $result = true;
        }
        return $result;
    }
}

<?php

namespace App\Models;

use Core\Model;

class ItemModel extends Model
{
    private $products;
    private $product;

    public function __construct()
    {
        parent::__construct();
        $this->products = "SELECT id, service_title FROM products";
        $this->product = "SELECT id, title, service_title, short_description, description, category_id, price
                          FROM products WHERE %s = :value";
    }

    /**
     * Returns item's ids list
     *
     * @return array
     */
    public function getItemsIdList(): array
    {
        return $this->queryList($this->products, 'id');
    }

    /**
     * Returns item's service titles list
     *
     * @return array
     */
    public function getItemsSTList(): array
    {
        return $this->queryList($this->products, 'service_title');
    }

    public function getFullItemInfo($id)
    {
        $flag = 'row';
        return $this->selectTypeAndQuery($this->product, $id, $flag);
    }

    public function getItemId($id)
    {
        $flag = 'col';
        $return = (int)$this->selectTypeAndQuery($this->product, $id, $flag, 'id');
        return $return;
    }

    public function getItemTitle($id)
    {
        $flag = 'col';
        return $this->selectTypeAndQuery($this->product, $id, $flag, 'title');
    }

    public function getItemServiceTitle($id)
    {
        $flag = 'col';
        return $this->selectTypeAndQuery($this->product, $id, $flag, 'service_title');
    }

    public function getItemShortDescription($id)
    {
        $flag = 'col';
        return $this->selectTypeAndQuery($this->product, $id, $flag, 'short_description');
    }

    public function getItemDescription($id)
    {
        $flag = 'col';
        return $this->selectTypeAndQuery($this->product, $id, $flag, 'description');
    }

    public function getItemCategoryId($id)
    {
        $flag = 'col';
        return $this->selectTypeAndQuery($this->product, $id, $flag, 'category_id');
    }

    public function getItemPrice($id)
    {
        $flag = 'col';
        return $this->selectTypeAndQuery($this->product, $id, $flag, 'price');
    }

    public function getCharacteristicsTitles($id)
    {
        $titles = "SELECT categories_characteristics.title
            FROM categories_characteristics
            JOIN products
            ON products.category_id = categories_characteristics.category_id
            WHERE products.%s = ?";
        $query = $this->selectCondition($titles, $id);
        return $this->queryList($query, 'title', [$id]);
    }

    public function getCharacteristicsValues($id)
    {
        $values = "SELECT products_characteristics.id,products_characteristics.value 
            FROM products_characteristics 
            JOIN products 
            ON products.id = products_characteristics.product_id 
            WHERE products.%s = ?";
        $query = $this->selectCondition($values, $id);
        return $this->queryList($query, 'value', [$id]);
    }

    public function getLastFiveItemsIds()
    {
        $list = "SELECT id FROM products ORDER BY created_at DESC LIMIT 5";
        return $this->queryList($list, 'id');
    }

    public function getItemsIdListByCategoryId($id)
    {
        $query = "SELECT id, title, service_title, short_description, description, category_id 
                          FROM products WHERE category_id = :category";
        return $this->queryList($query, 'id', ['category' => $id]);
    }
}
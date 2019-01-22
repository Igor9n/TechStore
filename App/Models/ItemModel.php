<?php
namespace App\Models;

use Core\Model;

class ItemModel extends Model
{
    private $products;
    private $product;

    public function __construct() {
        parent::__construct();
        $this->products ="SELECT id, service_title FROM products";
        $this->product = "SELECT id, title, service_title, short_description, description, category_id 
                          FROM products WHERE %s = :value";
    }

    public function getItemsIdList() {
        return $this->queryList($this->products,'id');
    }

    public function getItemsSTList() {
        return $this->queryList($this->products,'service_title');
    }

    public function getItemId($id) {
        $return = (int) $this->selectTypeAndQuery($this->product,$id, 'id');
        return $return;
    }

    public function getItemTitle($id) {
        return $this->selectTypeAndQuery($this->product,$id, 'title');
    }

    public function getItemServiceTitle($id) {
        return $this->selectTypeAndQuery($this->product,$id, 'service_title');
    }

    public function getItemShortDescription($id) {
        return $this->selectTypeAndQuery($this->product,$id, 'short_description');
    }

    public function getItemDescription($id) {
        return $this->selectTypeAndQuery($this->product,$id, 'description');
    }

    public function getItemCategoryId($id) {
        return $this->selectTypeAndQuery($this->product,$id, 'category_id');
    }

    public function getItemPrice($id) {
        $price = "SELECT products_availability.price 
            FROM products_availability
            JOIN products 
            ON products.id = products_availability.product_id 
            WHERE products.%s = ?";
        $query = $this->selectCondition($price, $id);
        return $this->queryList($query,'price',[$id])[0];
    }

    public function getCharacteriscticsTitles($id){
        $titles = "SELECT categories_characteristics.title
            FROM categories_characteristics
            JOIN products
            ON products.category_id = categories_characteristics.category_id
            WHERE products.%s = ?";
        $query = $this->selectCondition($titles, $id);
        return $this->queryList($query,'title',[$id]);
    }

    public function getCharacteriscticsValues($id) {
        $values = "SELECT products_characteristics.id,products_characteristics.value 
            FROM products_characteristics 
            JOIN products 
            ON products.id = products_characteristics.product_id 
            WHERE products.%s = ?";
        $query = $this->selectCondition($values, $id);
        return $this->queryList($query,'value',[$id]);
    }


    public function getLastFiveItemsIds(){
        $list = "SELECT id FROM products ORDER BY created_at DESC LIMIT 5";
        return $this->queryList($list, 'id');
    }
}
<?php
namespace App\Models;

use Core\Model;

class CategoryModel extends Model
{
    public $categories;
    public $category;

    public function __construct() {
        parent::__construct();
        $this->categories ="SELECT id, service_title FROM categories";
        $this->category = "SELECT id, title, service_title FROM categories WHERE %s = :value";
    }

    public function getCategoriesList() {
        return $this->queryList($this->categories,'id');
    }

    public function getCategoriesSTList() {
        return $this->queryList($this->categories,'service_title');
    }

    public function getCategoryId($id) {
        return $this->selectTypeAndQuery($this->category,$id, 'id');
    }

    public function getCategoryTitle($id) {
        return $this->selectTypeAndQuery($this->category,$id, 'title');
    }

    public function getCategoryServiceTitle($id) {
        return $this->selectTypeAndQuery($this->category,$id, 'service_title');
    }
}
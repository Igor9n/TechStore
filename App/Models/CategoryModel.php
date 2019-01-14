<?php
namespace App\Models;

use App\Core\Model;

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
        return $this->queryList($this->categories,0);
    }

    public function getCategoriesSTList() {
        return $this->queryList($this->categories,1);
    }

    public function getCategoryId($id) {
        return $this->selectTypeAndQuery($this->category,$id, 0);
    }

    public function getCategoryTitle($id) {
        return $this->selectTypeAndQuery($this->category,$id, 1);
    }

    public function getCategoryServiceTitle($id) {
        return $this->selectTypeAndQuery($this->category,$id, 2);
    }
}
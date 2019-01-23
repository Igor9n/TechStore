<?php

namespace App\Models;

use Core\Model;

class CategoryModel extends Model
{
    public $categories;
    public $category;

    public function __construct()
    {
        parent::__construct();
        $this->categories = "SELECT id, service_title FROM categories";
        $this->category = "SELECT id, title, service_title FROM categories WHERE %s = :value";
    }

    public function getCategoriesList()
    {
        return $this->queryList($this->categories, 'id');
    }

    public function getCategoriesSTList()
    {
        return $this->queryList($this->categories, 'service_title');
    }

    public function getFullCategoryInfo($id): array
    {
        $flag = 'row';
        return $this->selectTypeAndQuery($this->category, $id, $flag);
    }

    public function getCategoryId($id)
    {
        $flag = 'col';
        return $this->selectTypeAndQuery($this->category, $id, $flag, 'id');
    }

    public function getCategoryTitle($id)
    {
        $flag = 'col';
        return $this->selectTypeAndQuery($this->category, $id, $flag, 'title');
    }

    public function getCategoryServiceTitle($id)
    {
        $flag = 'col';
        return $this->selectTypeAndQuery($this->category, $id, $flag, 'service_title');
    }
}
<?php

namespace App\User\Models;

use Core\Model;

class CategoryModel extends Model
{
    private $categories;
    private $category;
    private $queryType;

    public function __construct()
    {
        parent::__construct();
        $this->categories = "SELECT id, service_title FROM categories";
        $this->category = "SELECT id, title, service_title FROM categories WHERE %s = :value";
        $this->queryType = 'col';
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
        $this->queryType = 'row';
        return $this->selectTypeAndQuery($this->category, $id, $this->queryType);
    }

    public function getCategoryId($id)
    {
        return $this->selectTypeAndQuery($this->category, $id, $this->queryType, 'id');
    }

    public function getCategoryTitle($id)
    {
        return $this->selectTypeAndQuery($this->category, $id, $this->queryType, 'title');
    }

    public function getCategoryServiceTitle($id)
    {
        return $this->selectTypeAndQuery($this->category, $id, $this->queryType, 'service_title');
    }
}
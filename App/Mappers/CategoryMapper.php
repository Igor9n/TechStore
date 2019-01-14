<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:03
 */


namespace App\Mappers;

use App\Core\Mapper;
use App\Data\Category;
use App\Models\CategoryModel;

class CategoryMapper extends Mapper
{
    public function __construct() {
        $this->model = new CategoryModel();
    }

    public function getArray(): array {
        $list = $this->model->getCategoriesList();
        return $this->getCategoriesArray($list);
    }

    public function getObject($id): Category {
        return Category::createObject([
            $this->model->getCategoryId($id),
            $this->model->getCategoryServiceTitle($id),
            $this->model->getCategoryTitle($id)
        ]);
    }

    private function getCategoriesArray(array $array): array {
        $categoriesArray = [];
        foreach ($array as $var){
            $categoriesArray[] = Category::createObject([
                $var,
                $this->model->getCategoryServiceTitle($var),
                $this->model->getCategoryTitle($var)
                ]);
        }
        return $categoriesArray;
    }
}
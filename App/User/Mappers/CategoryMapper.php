<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:03
 */


namespace App\User\Mappers;

use Core\Mapper;
use App\User\Data\Category;
use App\User\Models\CategoryModel;

class CategoryMapper extends Mapper
{
    public $item;

    public function __construct()
    {
        $this->model = new CategoryModel();
        $this->item = new ItemMapper();
    }

    /**
     * Returns category object
     *
     * @param $id
     * @return Category
     */
    public function getCategoryObject($id): Category
    {
        $categoryInfo = $this->model->getFullCategoryInfo($id);
        return Category::createObject([
            'id' => $categoryInfo['id'],
            'serviceTitle' => $categoryInfo['service_title'],
            'title' => $categoryInfo['title']
        ]);
    }

    /**
     * Returns categories array using categories list
     *
     * @param array $categoriesList
     * @return array
     */
    private function getCategoriesArray(array $categoriesList): array
    {
        $categoriesArray = [];
        foreach ($categoriesList as $category) {
            $categoriesArray[] = $this->getCategoryObject($category);
        }
        return $categoriesArray;
    }

    /**
     * Returns array with all categories objects
     *
     * @return array
     */
    public function getAllCategories(): array
    {
        $list = $this->model->getCategoriesList();
        return $this->getCategoriesArray($list);
    }
}
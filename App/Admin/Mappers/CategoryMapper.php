<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 25.01.19
 * Time: 18:26
 */

namespace App\Admin\Mappers;


use App\Admin\Data\Category;
use App\Admin\Models\CategoryModel;
use Core\Mapper;

class CategoryMapper extends Mapper
{
    public $item;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    /**
     * Returns category object
     *
     * @param array $categoryInfo
     * @param string $hasProducts
     * @return Category
     */
    public function getObject(array $categoryInfo, string $hasProducts): Category
    {
        return Category::createObject([
            'id' => $categoryInfo['id'],
            'serviceTitle' => $categoryInfo['service_title'],
            'title' => $categoryInfo['title']
        ], $hasProducts);
    }

    /**
     * Return category object by category id
     *
     * @param $id
     * @return Category
     */
    public function getCategoryObject($id)
    {
        $categoryInfo = $this->model->getFullCategoryInfo($id);
        if ($this->model->checkCategoryProducts($id)) {
            $hasProducts = 'Yes';
        } else {
            $hasProducts = 'No';
        }
        return $this->getObject($categoryInfo, $hasProducts);
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

    public function getCategoryInfo()
    {
        $info['title'] = $_POST['title'];
        $info['serviceTitle'] = $_POST['serviceTitle'];
        return $info;
    }

    public function insertCategoryInfo()
    {
        $info = $this->getCategoryInfo();
        return $this->model->insertCategoryInfo($info['title'], $info['serviceTitle']);
    }

    public function deleteCategoryInfo($id)
    {
        return $this->model->deleteCategoryInfo($id);
    }

    public function updateCategoryInfo($id)
    {
        $info = $this->getCategoryInfo();
        return $this->model->updateCategoryInfo($info['title'], $info['serviceTitle'], $id);
    }
}

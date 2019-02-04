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
use App\Admin\Validators\CategoryValidator;
use Core\Mapper;

class CategoryMapper extends Mapper
{
    public function __construct()
    {
        $this->model = new CategoryModel();
        $this->validator = new CategoryValidator();
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

    public function validateData(array $data)
    {
        $errors[] = $this->validator->validateServiceTitle($data['serviceTitle']);
        $errors[] = $this->validator->validateTitle($data['title']);
        return $this->makeSimpleArray($errors);
    }

    public function checkForErrors(array $info)
    {
        $errors = [];

        $errors['list'] = $this->validateData($info);
        $errors['action'] = $info['action'];

        if ($info['action'] === 'insert') {
            $errors['id'] = 'new';
        } else {
            $errors['id'] = $info['id'];
        }

        return $errors;
    }

    public function checkExists($title)
    {
        if (preg_match('/^[0-9]+$/', $title)) {
            $title = (int)$title;
        }
        $array = $this->getAllCategories();
        foreach ($array as $category) {
            if ($category->id === $title || $category->serviceTitle === $title) {
                return true;
            }
        }
        return false;
    }

    public function chooseMapper($key)
    {
        $result = false;

        if ($key === 'info') {
            $result = 'mapper';
        }

        if (!$result && ($key === 'characteristics')) {
            $result = 'characteristics';
        }
        return $result;
    }

    public function insert(array $info)
    {
        return $this->model->insertCategoryInfo($info['title'], $info['serviceTitle']);
    }

    public function delete(array $info)
    {
        return [
            $this->model->deleteCategoryCharacteristicsByCategory($info['id']),
            $this->model->deleteCategoryInfo($info['id'])
        ];
    }

    public function update(array $info)
    {
        return $this->model->updateCategoryInfo($info['title'], $info['serviceTitle'], $info['id']);
    }
}

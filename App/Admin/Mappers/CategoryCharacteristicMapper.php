<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 26.01.19
 * Time: 15:19
 */

namespace App\Admin\Mappers;


use App\Admin\Data\CategoryCharacteristic;
use App\Admin\Models\CategoryModel;
use App\Admin\Validators\CategoryCharacteristicValidator;
use App\Classes\Session;
use Core\Mapper;


class CategoryCharacteristicMapper extends Mapper
{
    public $userModel;

    public function __construct()
    {
        $this->model = new CategoryModel();
        $this->validator = new CategoryCharacteristicValidator();
    }

    public function getObject(array $characteristicInfo, string $inUsage): CategoryCharacteristic
    {
        return CategoryCharacteristic::createObject([
            'id' => $characteristicInfo['id'],
            'title' => $characteristicInfo['title'],
            'categoryId' => $characteristicInfo['category_id']
        ], $inUsage);
    }

    public function getCharacteristicObject(int $characteristicId): CategoryCharacteristic
    {
        $info = $this->model->getFullCategoryCharacteristicInfo($characteristicId);
        if ($this->model->checkCategoryCharacteristics($characteristicId)) {
            $inUsage = 'Yes';
        } else {
            $inUsage = 'No';
        }

        return $this->getObject($info, $inUsage);
    }

    public function getCharacteristicsArray(array $characteristicsList)
    {
        $result = [];
        foreach ($characteristicsList as $characteristic) {
            $result[] = $this->getCharacteristicObject($characteristic);
        }
        return $result;
    }

    public function getCharacteristicsByCategory($id)
    {
        $category = $this->model->getFullCategoryInfo($id);
        $list = $this->model->getCharacteristicsListByCategory($category['id']);
        return [
            'category' => $category,
            'characteristics' => $this->getCharacteristicsArray($list)
        ];
    }

    public function validateData(array $data)
    {
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

    public function insert(array $info)
    {
        return $this->model->insertCategoryCharacteristic($info['title'], $info['id']);
    }

    public function delete(array $info)
    {
        return $this->model->deleteCategoryCharacteristic($info['id']);
    }

    public function update(array $info)
    {
        return $this->model->updateCategoryCharacteristic($info['id'], $info['title']);
    }
}

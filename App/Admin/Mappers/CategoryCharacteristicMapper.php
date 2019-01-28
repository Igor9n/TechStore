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
use Core\Mapper;


class CategoryCharacteristicMapper extends Mapper
{
    public $userModel;

    public function __construct()
    {
        $this->model = new CategoryModel();
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

    public function getCharacteristicsListByCategory(int $id)
    {
        return $this->model->getCharacteristicsListByCategory($id);
    }

    public function getCharacteristicsArray(array $characteristicsList)
    {
        $result = [];
        foreach ($characteristicsList as $characteristic) {
            $result[] = $this->getCharacteristicObject($characteristic);
        }
        return $result;
    }

    public function getCharacteristicsByCategory(int $id)
    {
        $category = $this->model->getFullCategoryInfo($id);
        $list = $this->getCharacteristicsListByCategory($id);
        return [
            'category' => $category,
            'characteristics' => $this->getCharacteristicsArray($list)
        ];
    }

    public function getCharacteristicInfo()
    {
        if (isset($_POST['insert'])) {
            $info['category'] = $_POST['insert'];
        }
        $info['title'] = $_POST['title'];
        return $info;
    }

    public function insertCharacteristicInfo()
    {
        $info = $this->getCharacteristicInfo();
        return $this->model->insertCategoryCharacteristic($info['title'], $info['category']);
    }

    public function deleteCharacteristicInfo($id)
    {
        return $this->model->deleteCategoryCharacteristic($id);
    }

    public function updateCharacteristicInfo($id)
    {
        $info = $this->getCharacteristicInfo();
        return $this->model->updateCategoryCharacteristic($id, $info['title']);
    }
}

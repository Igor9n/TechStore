<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 04.02.19
 * Time: 14:22
 */

namespace App\Admin\Mappers;

use App\Admin\Data\Item;
use App\Admin\Data\ItemCharacteristic;
use App\Admin\Main\MainMapper;
use App\Admin\Models\ItemModel;
use App\Admin\Validators\ItemCharacteristicValidator;

class ItemCharacteristicMapper extends MainMapper
{
    public $categoryCharacteristics;

    public function __construct()
    {
        $this->model = new ItemModel();
        $this->categoryCharacteristics = new CategoryCharacteristicMapper();
        $this->validator = new ItemCharacteristicValidator();
    }

    public function getObject(array $characteristicInfo): ItemCharacteristic
    {
        return ItemCharacteristic::createObject([
            'id' => $characteristicInfo['id'],
            'title' => $characteristicInfo['title'],
            'value' => $characteristicInfo['value'],
            'category' => $characteristicInfo['category'],
            'characteristic' => $characteristicInfo['characteristic']
        ]);
    }

    private function groupCharacteristics($titles, $values)
    {
        $array = [];
        foreach ($titles as $title) {
            $result['title'] = $title->title;
            $result['value'] = 'No info';
            $result['id'] = '';
            $result['category'] = $title->categoryId;
            $result['characteristic'] = $title->id;
            for ($i = 0; $i < count($titles); $i++) {
                if (isset($values[$i]) && $title->id === (int)$values[$i]['characteristic_id']) {
                    $result['value'] = $values[$i]['value'];
                    $result['id'] = $values[$i]['id'];
                    break;
                }
            }
            $array[] = $this->getObject($result);
        }
        return $array;
    }

    public function getItemCharacteristics(Item $item)
    {
        $characteristicsList = $this->categoryCharacteristics->getCharacteristicsListByCategory($item->category->id);
        $characteristicsArray = $this->categoryCharacteristics->getCharacteristicsArray($characteristicsList);
        $values = $this->model->getProductCharacteristics($item->id);

        return $this->groupCharacteristics($characteristicsArray, $values);
    }

    public function delete(array $info)
    {
        return $this->model->deleteProductCharacteristicById($info['id']);
    }

    public function update(array $info)
    {
        return $this->model->updateProductCharacteristicValue(
            $info['id'],
            $info['value']
        );
    }

    public function insert(array $info)
    {
        return $this->model->insertProductCharacteristic(
            $info['product'],
            $info['characteristic'],
            $info['value']
        );
    }

    public function validateData(array $info)
    {
        $errors[] = $this->validator->validateValue($info['value']);
        return $this->makeSimpleArray($errors);
    }

    public function checkForErrors(array $info)
    {
        $errors = [];

        $errors['list'] = $this->validateData($info);
        $errors['action'] = $info['action'];
        $errors['key'] = $info['key'];

        return $errors;
    }
}

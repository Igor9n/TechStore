<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 27.01.19
 * Time: 12:59
 */

namespace App\Admin\Mappers;


use App\Admin\Data\Item;
use App\Admin\Main\MainMapper;
use App\Admin\Models\ItemModel;
use App\Admin\Validators\ItemValidator;

class ItemMapper extends MainMapper
{
    public $categoryMapper;
    public $characteristics;

    public function __construct()
    {
        $this->model = new ItemModel();
        $this->categoryMapper = new CategoryMapper();
        $this->characteristics = new CategoryCharacteristicMapper();
        $this->validator = new ItemValidator();
    }

    public function getObject(array $itemInfo, string $inUsage): Item
    {
        return Item::createObject([
            'id' => $itemInfo['id'],
            'title' => $itemInfo['title'],
            'serviceTitle' => $itemInfo['service_title'],
            'warranty' => $itemInfo['warranty'],
            'price' => (int)$itemInfo['price'],
            'category' => $itemInfo['category_id'],
            'visible' => $itemInfo['visible'],
            'shortDescription' => $itemInfo['short_description'],
            'description' => $itemInfo['description'],
        ], $inUsage);
    }

    public function getItemObject($id)
    {
        $itemInfo = $this->model->getFullProductInfo($id);
        if ($this->model->checkItemUsage($id)) {
            $inUsage = 'Yes';
        } else {
            $inUsage = 'No';
        }

        $itemInfo['category_id'] = $this->categoryMapper->getCategoryObject($itemInfo['category_id']);

        return $this->getObject($itemInfo, $inUsage);
    }

    private function getItemsArray(array $itemsList): array
    {
        $itemsArray = [];
        foreach ($itemsList as $item) {
            $itemsArray[] = $this->getItemObject($item);
        }
        return $itemsArray;
    }

    public function getAllItems(): array
    {
        $list = $this->model->getProductsList();
        return $this->getItemsArray($list);
    }

    public function insert(array $info)
    {
        return $this->model->insertProductInfo(
            $info['title'],
            $info['serviceTitle'],
            $info['warranty'],
            $info['price'],
            $info['category'],
            $info['shortDescription'],
            $info['description'],
            $info['visible']
        );
    }

    public function delete(array $info)
    {
        return [
            $this->model->deleteProductInfo($info['id']),
            $this->model->deleteProductsCharacteristics($info['id'])
        ];
    }

    public function update(array $info)
    {
        return $this->model->updateProductInfo(
            $info['id'],
            $info['title'],
            $info['serviceTitle'],
            $info['warranty'],
            $info['shortDescription'],
            $info['description'],
            $info['category'],
            $info['price'],
            $info['visible']
        );
    }

    public function checkExists($title)
    {
        if (preg_match('/^[0-9]+$/', $title)) {
            $title = (int)$title;
        }
        $array = $this->getAllItems();

        foreach ($array as $item) {
            if ($item->id === $title || $item->serviceTitle === $title) {
                return true;
            }
        }
        return false;
    }

    public function validateData(array $data)
    {
        $errors[] = $this->validator->validateServiceTitle($data['serviceTitle']);
        $errors[] = $this->validator->validateTitle($data['title']);
        $errors[] = $this->validator->validateWarranty($data['warranty']);
        $errors[] = $this->validator->validatePrice($data['price']);
        $errors[] = $this->validator->validateShortDescription($data['shortDescription']);
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


<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 27.01.19
 * Time: 12:59
 */

namespace App\Admin\Mappers;


use App\Admin\Data\Item;
use App\Admin\Models\ItemModel;
use Core\Mapper;

class ItemMapper extends Mapper
{
    public $categoryMapper;
    public $characteristics;

    public function __construct()
    {
        $this->model = new ItemModel();
        $this->categoryMapper = new CategoryMapper();
        $this->characteristics = new CategoryCharacteristicMapper();
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

    private function groupCharacteristics($titles, $values)
    {
        $array = [];
        foreach ($titles as $title) {
            for ($i = 0; $i < count($titles); $i++) {
                $array[$title->id]['info'] = $title;
                if (isset($values[$i]) && $title->id === (int)$values[$i]['characteristic_id']) {
                    $array[$title->id]['value'] = $values[$i];
                    break;
                } else {
                    $array[$title->id]['value'] = 'No info';
                }
            }
        }
        return $array;
    }

    public function getItemCharacteristics(Item $item)
    {
        $characteristicsList = $this->characteristics->getCharacteristicsListByCategory($item->category->id);
        $characteristicsArray = $this->characteristics->getCharacteristicsArray($characteristicsList);
        $values = $this->model->getProductCharacteristics($item->id);

        return $this->groupCharacteristics($characteristicsArray, $values);
    }

    public function getAlItems(): array
    {
        $list = $this->model->getProductsList();
        return $this->getItemsArray($list);
    }

    public function getItemInfo()
    {
        $info['title'] = $_POST['title'];
        $info['serviceTitle'] = $_POST['serviceTitle'];
        $info['warranty'] = $_POST['warranty'];
        $info['price'] = $_POST['price'];
        $info['category'] = (int)$_POST['category'];
        $info['shortDescription'] = $_POST['shortDescription'];
        $info['description'] = $_POST['description'];
        $info['visible'] = $_POST['visible'];

        return $info;
    }

    public function getCharacteristicInfo()
    {
        $info['product'] = (int)$_POST['product'];
        $info['value'] = $_POST['value'];
        $info['characteristic'] = (int)$_POST['insert'];
        return $info;
    }

    public function insertItemInfo()
    {
        $info = $this->getItemInfo();
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

    public function deleteItemInfo($id)
    {
        return [
            $this->model->deleteProductInfo($id),
            $this->model->deleteProductsCharacteristics($id)
        ];
    }

    public function updateItemInfo($id)
    {
        $info = $this->getItemInfo();
        return $this->model->updateProductInfo(
            $id,
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

    public function deleteItemCharacteristic($id)
    {
        return $this->model->deleteProductCharacteristicById($id);
    }

    public function updateItemCharacteristic($id)
    {
        return $this->model->updateProductCharacteristicValue(
            $id,
            $_POST['value']
        );
    }

    public function insertCharacteristic()
    {
        $info = $this->getCharacteristicInfo();
        return $this->model->insertProductCharacteristic(
            $info['product'],
            $info['characteristic'],
            $info['value']
        );
    }
}

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
    public function __construct()
    {
        $this->model = new ItemModel();
        $this->categoryMapper = new CategoryMapper();
    }

    public function getObject(array $itemInfo, string $inUsage): Item
    {
        return Item::createObject([
            'id' => $itemInfo['id'],
            'title' => $itemInfo['title'],
            'serviceTitle' => $itemInfo['service_title'],
            'warranty' => $itemInfo['warranty'],
            'price' => $itemInfo['price'],
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
//
//    public function updateCategoryInfo($id)
//    {
//        $info = $this->getCategoryInfo();
//        return $this->model->updateCategoryInfo($info['title'], $info['serviceTitle'], $id);
//    }
}

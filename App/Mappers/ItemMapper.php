<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:03
 */
namespace  App\Mappers;

use Core\Mapper;
use App\Data\Item;
use App\Models\ItemModel;

class ItemMapper extends  Mapper
{
    public function __construct() {
        $this->model = new ItemModel();
    }

    public function getArray($list): array {
        return $this->getItemsArray($list);
    }

    public function getObject($id): Item {
        return Item::createObject([
            'id' => $this->model->getItemId($id),
            'serviceTitle' => $this->model->getItemServiceTitle($id),
            'categoryId' => $this->model->getItemCategoryId($id),
            'title' => $this->model->getItemTitle($id),
            'characteristicsTitles' => $this->model->getCharacteriscticsTitles($id),
            'characteristicsValues' => $this->model->getCharacteriscticsValues($id),
            'shortDescription' => $this->model->getItemShortDescription($id),
            'description' => $this->model->getItemDescription($id),
            'price' => $this->model->getItemPrice($id)
        ]);
    }
//

    private function getItemsArray(array $array): array {
        $itemsArray = [];
        foreach ($array as $var){
            $itemsArray[] = Item::createObject([
                'id' => $this->model->getItemId($var),
                'serviceTitle' => $this->model->getItemServiceTitle($var),
                'categoryId' => $this->model->getItemCategoryId($var),
                'title' => $this->model->getItemTitle($var),
                'characteristicsTitles' => $this->model->getCharacteriscticsTitles($var),
                'characteristicsValues' => $this->model->getCharacteriscticsValues($var),
                'shortDescription' => $this->model->getItemShortDescription($var),
                'description' => $this->model->getItemDescription($var),
                'price' => $this->model->getItemPrice($var)
            ]);
        }
        return $itemsArray;
    }
}
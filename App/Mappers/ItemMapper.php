<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:03
 */

namespace App\Mappers;

use Core\Mapper;
use App\Data\Item;
use App\Models\ItemModel;

class ItemMapper extends Mapper
{
    public function __construct()
    {
        $this->model = new ItemModel();
    }

    /**
     * Returns item's object by id
     *
     * @param $id
     * @return Item
     */
    public function getItemObject($id): Item
    {
        $itemInfo = $this->model->getFullItemInfo($id);
        return Item::createObject([
            'id' => $itemInfo['id'],
            'serviceTitle' => $itemInfo['service_title'],
            'categoryId' => $itemInfo['category_id'],
            'title' => $itemInfo['title'],
            'characteristicsTitles' => $this->model->getCharacteristicsValues($id),
            'characteristicsValues' => $this->model->getCharacteristicsValues($id),
            'shortDescription' => $itemInfo['short_description'],
            'description' => $itemInfo['description'],
            'price' => $itemInfo['price']
        ]);
    }

    /**
     * Returns item's objects list by item's list
     *
     * @param array $itemsList
     * @return array
     */
    private function getItemsArray(array $itemsList): array
    {
        $itemsArray = [];
        foreach ($itemsList as $item) {
            $itemsArray[] = $this->getItemObject($item);
        }
        return $itemsArray;
    }

    /**
     * Returns last five added to DB items
     *
     * @return array
     */
    public function getFiveItems()
    {
        return $this->getItemsArray($this->model->getLastFiveItemsIds());
    }

    /**
     * Return all items
     *
     * @return array
     */
    public function getAllItems()
    {
        return $this->getItemsArray($this->model->getItemsIdList());
    }

    /**
     * Returns items list based on category id
     *
     * @param $id
     * @return array
     */
    public function getItemsByCategoryId($id)
    {
        return $this->getItemsArray($this->model->getItemsIdListByCategoryId($id));
    }
}
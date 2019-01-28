<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:02
 */

namespace App\User\Data;

class Item
{
    public $id;
    public $serviceTitle;
    public $categoryId;
    public $title;
    public $characteristics;
    public $shortDescription;
    public $description;
    public $price;

    public function __construct(
        int $id,
        string $serviceTitle,
        $categoryId,
        string $title,
        array $characteristicsTitles,
        array $characteristicsValues,
        string $shortDescription,
        string $description,
        string $price
    ) {
        $this->id = $id;
        $this->serviceTitle = $serviceTitle;
        $this->categoryId = $categoryId;
        $this->title = $title;
        $this->shortDescription = $shortDescription;
        $this->description = $description;
        $this->price = $price;
        $this->listCharacteristics($characteristicsTitles, $characteristicsValues);
    }

    private function listCharacteristics($titles, $values)
    {
        $array = [];
        foreach ($titles as $key => $value) {
            if (isset($values[$key])) {
                $array[$value] = $values[$key];
                continue;
            }
            $array[$value] = 'No info';
        }
        $this->characteristics = $array;
    }

    public static function createObject(array $array): Item
    {
        return new self(
            $array['id'],
            $array['serviceTitle'],
            $array['categoryId'],
            $array['title'],
            $array['characteristicsTitles'],
            $array['characteristicsValues'],
            $array['shortDescription'],
            $array['description'],
            $array['price']
        );
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:02
 */

namespace App\Data;

class Item
{
    public $id;
    public $serviceTitle;
    public $categoryId;
    public $title;
    public $characteristics;
    public $characteristicsTitles;
    public $characteristicsValues;
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
        $this->characteristicsTitles = $characteristicsTitles;
        $this->characteristicsValues = $characteristicsValues;
        $this->listCharacteristics($this->characteristicsTitles, $this->characteristicsValues);
    }

    private function listCharacteristics($titles, $values)
    {
        for ($i = 0; $i < count($titles); $i++) {
            $this->characteristics[$titles[$i]] = $values[$i];
        }
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
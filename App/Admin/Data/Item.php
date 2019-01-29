<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 25.01.19
 * Time: 18:18
 */

namespace App\Admin\Data;


class Item
{
    public $id;
    public $title;
    public $serviceTitle;
    public $warranty;
    public $price;
    public $category;
    public $visible;
    public $shortDescription;
    public $description;
    public $inUsage;

    public function __construct(
        int $id,
        string $title,
        string $serviceTitle,
        string $warranty,
        int $price,
        object $category,
        string $visible,
        string $shortDescription,
        string $description,
        string $inUsage
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->serviceTitle = $serviceTitle;
        $this->warranty = $warranty;
        $this->price = $price;
        $this->category = $category;
        $this->visible = $visible;
        $this->shortDescription = $shortDescription;
        $this->description = $description;
        $this->inUsage = $inUsage;
    }

    public static function createObject(array $array, string $inUsage): Item
    {
        return new self(
            $array['id'],
            $array['title'],
            $array['serviceTitle'],
            $array['warranty'],
            $array['price'],
            $array['category'],
            $array['visible'],
            $array['shortDescription'],
            $array['description'],
            $inUsage
        );
    }
}

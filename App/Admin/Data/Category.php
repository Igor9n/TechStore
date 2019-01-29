<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 25.01.19
 * Time: 18:18
 */

namespace App\Admin\Data;


class Category
{
    public $id;
    public $serviceTitle;
    public $title;
    public $hasProducts;

    public function __construct(int $id, string $serviceTitle, string $title, string $hasProducts)
    {
        $this->id = $id;
        $this->serviceTitle = $serviceTitle;
        $this->title = $title;
        $this->hasProducts = $hasProducts;
    }

    public static function createObject(array $categoriesList, string $hasProducts): Category
    {
        return new self(
            $categoriesList['id'],
            $categoriesList['serviceTitle'],
            $categoriesList['title'],
            $hasProducts
        );
    }
}

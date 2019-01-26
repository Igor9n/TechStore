<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 26.01.19
 * Time: 15:20
 */

namespace App\Admin\Data;


class CategoryCharacteristic
{
    public $id;
    public $title;
    public $categoryId;
    public $inUsage;

    public function __construct(int $id, string $title, int $categoryId, string $inUsage)
    {
        $this->id = $id;
        $this->title = $title;
        $this->categoryId = $categoryId;
        $this->inUsage = $inUsage;
    }

    public static function createObject(array $characteristicInfo, string $inUsage): CategoryCharacteristic
    {
        return new self(
            $characteristicInfo['id'],
            $characteristicInfo['title'],
            $characteristicInfo['categoryId'],
            $inUsage
        );
    }

}
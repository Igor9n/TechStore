<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 04.02.19
 * Time: 14:23
 */

namespace App\Admin\Data;


class ItemCharacteristic
{
    public $id;
    public $title;
    public $value;
    public $category;
    public $characteristic;

    public function __construct($id, string $title, string $value, $category, $characteristic)
    {
        $this->title = $title;
        $this->id = $id;
        $this->value = $value;
        $this->category = $category;
        $this->characteristic = $characteristic;
    }

    public static function createObject(array $characteristicInfo): ItemCharacteristic
    {
        return new self(
            $characteristicInfo['id'],
            $characteristicInfo['title'],
            $characteristicInfo['value'],
            $characteristicInfo['category'],
            $characteristicInfo['characteristic']
        );
    }
}

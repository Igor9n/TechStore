<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 11.01.19
 * Time: 16:02
 */
namespace App\Data;

class Category
{
    public $id;
    public $serviceTitle;
    public $title;

    public function __construct(int $id, string $serviceTitle, string $title) {
        $this->id = $id;
        $this->serviceTitle = $serviceTitle;
        $this->title = $title;
    }

    public static function createObject(array $array): Category {
        return new self(
            $array['0'],
            $array['1'],
            $array['2']
        );
    }
}
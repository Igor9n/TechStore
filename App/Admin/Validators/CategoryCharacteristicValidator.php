<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 29.01.19
 * Time: 16:00
 */

namespace App\Admin\Validators;

class CategoryCharacteristicValidator
{
    public function validateTitle(string $title)
    {
        $errors = [];
        if (!preg_match('/^[a-zA-Z#]+([\s-]?)[a-zA-Z]+([\s-]?)[a-zA-Z]+$/', $title)) {
            $errors['titleChars'] = '<strong>Title </strong> must contains only english characters and two spaces/hyphens between';
        }
        if (strlen($title) < 3 || strlen($title) > 30) {
            $errors['titleCount'] = '<strong>Title </strong>must have min 3 and max 30 symbols';
        }
        return $errors;
    }
}

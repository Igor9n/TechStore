<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 04.02.19
 * Time: 23:16
 */

namespace App\Admin\Validators;


class ItemCharacteristicValidator
{
    public function validateValue(string $title)
    {
        $errors = [];
        if (!preg_match('/^[a-zA-Z0-9,\'\\/\s-]+$/', $title)) {
            $errors['valueChars'] = 'For<strong> value </strong>allowed english characters, numbers, space, slash, dash or coma';
        }
        if (strlen($title) < 1 || strlen($title) > 30) {
            $errors['valueCount'] = '<strong>Value </strong>must have min 1 and max 30 symbols';
        }
        return $errors;
    }
}

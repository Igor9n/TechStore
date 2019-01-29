<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 29.01.19
 * Time: 11:18
 */

namespace App\Admin\Validators;


class CategoryValidator
{
    public function validateTitle(string $title)
    {
        $errors = [];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['titleChars'] = '<strong>Title </strong> must contains only english characters and spaces';
        }
        if (strlen($title) < 3 || strlen($title) > 30) {
            $errors['titleCount'] = '<strong>Title </strong>must have min 3 and max 30 symbols';
        }
        return $errors;
    }

    public function validateServiceTitle(string $service)
    {
        $errors = [];
        if (!preg_match('/^[a-z]+$/', $service)) {
            $errors['titleChars'] = '<strong>Service title </strong> must contains only lowercase english characters';
        }
        if (strlen($service) < 3 || strlen($service) > 30) {
            $errors['titleCount'] = '<strong>Service title </strong> must have min 3 and max 20 symbols';
        }
        return $errors;
    }
}
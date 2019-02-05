<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 04.02.19
 * Time: 20:10
 */

namespace App\Admin\Validators;


class ItemValidator
{
    public function validatePrice(string $title)
    {
        $errors = [];
        if (!preg_match('/^[0-9]+$/', $title)) {
            $errors['priceChars'] = 'For<strong> price </strong>allowed numbers only';
        }
        if (strlen($title) < 3 || strlen($title) > 10) {
            $errors['priceCount'] = '<strong>Price </strong>must have min 3 and max 10 symbols';
        }
        return $errors;
    }

    public function validateTitle(string $title)
    {
        $errors = [];
        if (!preg_match('/^[a-zA-Z0-9\'+#\s]+$/', $title)) {
            $errors['titleChars'] = 'For<strong> title </strong>allowed english characters, numbers, -, _, \', # and spaces ';
        }
        if (strlen($title) < 3 || strlen($title) > 50) {
            $errors['titleCount'] = '<strong>Title </strong>must have min 3 and max 50 symbols';
        }
        return $errors;
    }

    public function validateServiceTitle(string $title)
    {
        $errors = [];
        if (!preg_match('/^[a-z0-9]+$/', $title)) {
            $errors['titleSChars'] = 'For<strong> service title </strong>allowed english characters nad numbers ';
        }
        if (strlen($title) < 3 || strlen($title) > 20) {
            $errors['titleSCount'] = '<strong>Service title </strong>must have min 3 and max 20 symbols';
        }
        return $errors;
    }

    public function validateWarranty(string $title)
    {
        $errors = [];
        if (!preg_match('/^[0-9]{1,2}([\s]{1})[a-z]+$/', $title)) {
            $errors['warrantyChars'] = 'For<strong> warranty </strong>allowed english characters, numbers and 1 space between';
        }
        if (strlen($title) < 3 || strlen($title) > 10) {
            $errors['warrantyCount'] = '<strong>Warranty </strong>must have min 3 and max 10 symbols';
        }
        return $errors;
    }

    public function validateShortDescription(string $title)
    {
        $errors = [];
        if (strlen($title) < 3 || strlen($title) > 100) {
            $errors['shortDescriptionCount'] = '<strong>Short description </strong>must have min 3 and max 100 symbols';
        }
        return $errors;
    }
}

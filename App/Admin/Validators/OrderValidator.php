<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 06.02.19
 * Time: 21:28
 */

namespace App\Admin\Validators;


class OrderValidator
{
    public function validateDeliveryDate($title)
    {
        $errors = [];
        if (!preg_match('/^[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}$/', $title)) {
            $errors['dateFormat'] = 'Valid <strong>delivery date</strong> format is <strong>dd.mm.yyyy</strong>';
        }
        return $errors;
    }

    public function validateDeliveryTime($title)
    {
        $errors = [];
        if (!preg_match('/^[0-9]{1,2}[-]{1}[0-9]{1,2}$/', $title)) {
            $errors['dateFormat'] = 'Valid <strong>delivery time</strong> format is <strong>hh-hh or h-h</strong>';
        }
        return $errors;
    }
}

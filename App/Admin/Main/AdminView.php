<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 23.01.19
 * Time: 11:00
 */

namespace App\Admin\Main;

use Core\View;

class AdminView extends View
{
    public function generate($template, $content, $data = [], $path = '../App/Admin/views/')
    {
        parent::generate($template, $content, $data, $path);
    }
}
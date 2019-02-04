<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 07.01.19
 * Time: 11:11
 */

namespace Core;

use App\Classes\Session;

class Controller
{
    public $model;
    public $view;
    public $mapper;

    public function __construct()
    {
        $this->view = new View();
    }


}

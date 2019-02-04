<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 28.01.19
 * Time: 15:36
 */

namespace App\Admin\Controllers;


use App\Admin\Main\MainController;
use App\Admin\Mappers\ItemInfoMapper;
use App\Admin\Mappers\ItemMapper;

class ItemInfoController extends MainController
{
    public $info;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new ItemMapper();
        $this->info = new ItemMapper();
    }


    public function actionUpdate()
    {
        if (!isset($_POST['update'])) {
            header("Location: /admin");
        }

        $this->mapper->updateItemInfo($_POST['update']);

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function actionDelete()
    {
        if (!isset($_POST['update'])) {
            header("Location: /admin");
        }

        $this->mapper->updateItemInfo($_POST['update']);

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function actionInsert()
    {
        if (!isset($_POST['update'])) {
            header("Location: /admin");
        }

//        $this->mapper->updateItemInfo($_POST['update']);

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function actionChange()
    {
        if (!isset($_POST['update'])) {
            header("Location: /admin");
        }

//        $this->mapper->updateItemInfo($_POST['update']);

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
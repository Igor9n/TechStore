<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 28.01.19
 * Time: 15:36
 */

namespace App\Admin\Controllers;


use App\Admin\Mappers\ItemInfoMapper;
use App\Admin\Mappers\ItemMapper;
use Core\Controller;

class ItemInfoController extends Controller
{
    public $info;
    public function __construct()
    {
        $this->mapper = new ItemMapper();
        $this->info = new ItemInfoMapper();
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
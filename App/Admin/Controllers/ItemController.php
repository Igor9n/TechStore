<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 27.01.19
 * Time: 11:53
 */

namespace App\Admin\Controllers;


use App\Admin\Main\AdminView;
use App\Admin\Mappers\ItemMapper;
use Core\Controller;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->mapper = new ItemMapper();
        $this->view = new AdminView();
    }

    public function getItems()
    {
        return $this->mapper->getAlItems();
    }

    public function actionInsert()
    {
        if (!isset($_POST['insert'])) {
            header("Location: /admin");
        }

        $this->mapper->insertItemInfo();

        header("Location: /admin/items");
    }

    public function actionDelete()
    {
        if (!isset($_POST['delete'])) {
            header("Location: /admin");
        }

        $this->mapper->deleteItemInfo($_POST['delete']);

        header("Location: /admin/items");
    }
//
//    public function actionUpdate()
//    {
//        if (!isset($_POST['update'])) {
//            header("Location: /admin");
//        }
//
//        $this->mapper->updateItemInfo($_POST['update']);
//
//        header("Location: /admin/categories");
//    }
}
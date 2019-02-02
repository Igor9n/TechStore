<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 27.01.19
 * Time: 11:53
 */

namespace App\Admin\Controllers;


use App\Admin\Data\Item;
use App\Admin\Main\AdminView;
use App\Admin\Mappers\ItemMapper;
use Core\Controller;

class ItemController extends Controller
{
    public $categories;
    public function __construct()
    {
        $this->mapper = new ItemMapper();
        $this->view = new AdminView();
        $this->categories = new CategoryController();
    }

    public function getItems()
    {
        return $this->mapper->getAlItems();
    }

    public function getCharacteristics(Item $item)
    {
        return $this->mapper->getItemCharacteristics($item);
    }

    public function getItem($id)
    {
        return $this->mapper->getItemObject($id);
    }

    public function actionNew()
    {
        if (!isset($_POST['new'])) {
            header("Location: /admin");
        }

        $this->mapper->insertItemInfo();

        header("Location: /admin/items");
    }

    public function actionRemove()
    {
        if (!isset($_POST['remove'])) {
            header("Location: /admin");
        }

        $this->mapper->deleteItemInfo($_POST['remove']);

        header("Location: /admin/items");
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
        if (!isset($_POST['delete'])) {
            header("Location: /admin");
        }

        $this->mapper->deleteItemCharacteristic($_POST['delete']);

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function actionModify()
    {
        if (!isset($_POST['modify'])) {
            header("Location: /admin");
        }
        $this->mapper->updateItemCharacteristic($_POST['modify']);

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function actionInsert()
    {
        if (!isset($_POST['insert'])) {
            header("Location: /admin");
        }

        $this->mapper->insertCharacteristic();

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function actionAll()
    {
        $data['items'] = $this->getItems();
        $data['title'] = 'All items';
        $data['categories'] = $this->categories->getCategories();

        $this->view->render('admin_items', $data);
    }
}

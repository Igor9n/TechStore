<?php

namespace App\Controllers;

use App\Classes\Session;
use Core\Route;
use App\Mappers\ItemMapper;
use App\Models\ItemModel;

class ItemController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ItemModel();
        $this->mapper = new ItemMapper();
    }

    public function actionView($id)
    {
        if (!Route::checkExist($id, $this->model->getItemsSTList())) {
            Route::ErrorPage404();
        }

        $data['info'] = $this->mapper->getItemObject($id);
        $data['title'] = $data['info']->title;

        $this->view->generate('template.php', 'item.php', $data);
    }

    /**
     * Adding item to cart
     */
    public function actionAdd()
    {
        $id = (int)$_GET['id'];

        if (!isset($id)) {
            header("Location: /");
        }

        Session::additionalSessionStart();
        $_SESSION['item'] = $this->mapper->getItemObject($id);
        header("Location: /cart/add");
    }
}
<?php

namespace App\User\Controllers;

use App\Classes\Session;
use Core\Route;
use App\User\Mappers\ItemMapper;
use App\User\Models\ItemModel;

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
            Route::errorPage404();
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
        Session::set('item', $this->mapper->getItemObject($id));
        header("Location: /cart/add");
    }
}
<?php

namespace App\Controllers;

use App\Mappers\ItemMapper;
use Core\{Controller, Route};
use App\Mappers\CategoryMapper;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public $item;

    public function __construct()
    {
        parent::__construct();
        $this->model = new CategoryModel();
        $this->mapper = new CategoryMapper();
        $this->item = new ItemMapper();
    }

    function actionView($id)
    {
        if ($id === 'all') {
            $data['products'] = $this->item->getAllItems();
        } else {
            if (Route::checkExist($id, $this->model->getCategoriesSTList())) {
                $data['products'] = $this->mapper->getItemsByCategory($this->model->getCategoryId($id));
            } else {
                Route::ErrorPage404();
            }
        }

        $data['category'] = $this->mapper->getCategoryObject($id);
        $data['title'] = $data['category']->title;
        $this->view->generate('template.php', 'category.php', $data);
    }
}
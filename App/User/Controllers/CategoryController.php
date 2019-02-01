<?php

namespace App\User\Controllers;

use App\User\Mappers\ItemMapper;
use Core\{Controller, Route};
use App\User\Mappers\CategoryMapper;
use App\User\Models\CategoryModel;

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

    public function actionView($id)
    {

        if (!Route::checkExist($id, $this->model->getCategoriesSTList())) {
            Route::errorPage404();
        }

        $data['category'] = $this->mapper->getCategoryObject($id);

        if ($id === 'all') {
            $data['products'] = $this->item->getAllItems();
        } else {
            $data['products'] = $this->item->getItemsByCategoryId($data['category']->id);
        }

        $data['title'] = $data['category']->title;
        $this->view->render('category', $data);
    }
}
<?php
namespace App\Controllers;

use Core\{Controller,Route};
use App\Mappers\CategoryMapper;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public $item;

    public function __construct() {
        parent::__construct();
        $this->model = new CategoryModel();
        $this->item = new ItemController();
        $this->mapper = new CategoryMapper();
    }

    public function getItemsByCategory($id) {
        $array = $this->item->getAllItems();
        $resultItems = [];
        foreach ($array as $value) {
            if ( $value->categoryId === $id ) {
                $resultItems[] = $value;
            }
        }
        return $resultItems;
    }

    public function getAllCategories(): array {
        return $cats = $this->mapper->getArray();
    }

    public function getCategoryInfo($id): object {
        return $this->mapper->getObject($id);
    }

    function actionView($id) {
        if ($id === 'all') {
            $data['products'] = $this->item->getAllItems();
        } else {
            if (Route::checkExist($id, $this->model->getCategoriesSTList())) {
                $data['products'] = $this->getItemsByCategory($this->model->getCategoryId($id));
            } else {
                Route::ErrorPage404();
            }
        }
        $data['category'] = $this->mapper->getObject($id);
        $data['title'] = $data['category']->title;
        $this->view->generate('template.php','category.php', $data);
    }
}
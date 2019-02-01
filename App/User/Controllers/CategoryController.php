<?php

namespace App\User\Controllers;

use App\User\Mappers\ItemMapper;
use Core\{Controller, CustomRedirect, Route};
use App\User\Mappers\CategoryMapper;

class CategoryController extends Controller
{
    public $item;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new CategoryMapper();
        $this->item = new ItemMapper();
    }

    public function actionView($params)
    {
        $id = $params['id'];

        if (!$this->mapper->checkExists($id)) {
            CustomRedirect::redirect('404');
        }

        $data[CATEGORY] = $this->mapper->getCategoryObject($id);

        if ($id === 'all' || $id === '0') {
            $data['products'] = $this->item->getAllItems();
        } else {
            $data['products'] = $this->item->getItemsByCategoryId($data[CATEGORY]->id);
        }

        $data['title'] = $data[CATEGORY]->title;
        $this->view->render('category', $data);
    }
}
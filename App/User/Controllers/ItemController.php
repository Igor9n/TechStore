<?php

namespace App\User\Controllers;

use App\Classes\Session;
use Core\CustomRedirect;
use App\User\Mappers\ItemMapper;
use App\User\Models\ItemModel;
use Core\Request;

class ItemController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ItemModel();
        $this->mapper = new ItemMapper();
    }

    public function actionView(Request $request)
    {
        $id = $request->getParam('id');

        if (!$this->mapper->checkExists($id)) {
            CustomRedirect::redirect('404');
        }

        $data['info'] = $this->mapper->getItemObject($id);
        $data['title'] = $data['info']->title;

        $this->view->initView('item', $data);
    }

    public function actionAdd(Request $request)
    {
        $id = $request->getPostParam('id');

        if (!$this->mapper->checkExists($id)) {
            CustomRedirect::redirect('404');
        }

        Session::additionalSessionStart();
        Session::set('item', $this->mapper->getItemObject($id));
        CustomRedirect::redirect('cart/add');
    }
}

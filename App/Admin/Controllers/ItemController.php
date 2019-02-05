<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 27.01.19
 * Time: 11:53
 */

namespace App\Admin\Controllers;


use App\Admin\Data\Item;
use App\Admin\Main\MainController;
use App\Admin\Main\MainView;
use App\Admin\Mappers\CategoryMapper;
use App\Admin\Mappers\ItemCharacteristicMapper;
use App\Admin\Mappers\ItemMapper;
use Core\CustomRedirect;
use Core\Request;

class ItemController extends MainController
{
    public $categories;
    public $characteristics;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new ItemMapper();
        $this->view = new MainView();
        $this->categories = new CategoryMapper();
        $this->characteristics = new ItemCharacteristicMapper();
    }

    public function getCharacteristics(Item $item)
    {
        return $this->characteristics->getItemCharacteristics($item);
    }

    public function getItem($id)
    {
        return $this->mapper->getItemObject($id);
    }

    public function actionDelete(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionUpdate(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionInsert(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionAll()
    {
        $data['items'] = $this->mapper->getAllItems();
        $data['title'] = 'All items';
        $data['categories'] = $this->categories->getAllCategories();
        $data['errors'] = $this->getErrors();

        $this->view->render('admin_items', $data);
    }

    public function actionOne(Request $request)
    {
        $id = $request->getParam('id');

        if (!$this->mapper->checkExists($id)) {
            CustomRedirect::redirect('404');
        }

        $data['item'] = $this->mapper->getItemObject($id);
        $data['categories'] = $this->categories->getAllCategories();
        $data['characteristics'] = $this->getCharacteristics($data['item']);
        $data['title'] = 'Product info';
        $data['errors'] = $this->getErrors();


        $this->view->render('admin_item', $data);
    }
}

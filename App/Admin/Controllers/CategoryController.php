<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 26.01.19
 * Time: 10:47
 */

namespace App\Admin\Controllers;


use App\Admin\Main\MainController;
use App\Admin\Mappers\CategoryCharacteristicMapper;
use App\Admin\Mappers\CategoryMapper;
use Core\CustomRedirect;
use Core\Request;

class CategoryController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->mapper = new CategoryMapper();
        $this->characteristics = new CategoryCharacteristicMapper();
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
        $data['categories'] = $this->mapper->getAllCategories();
        $data['title'] = 'All categories';
        $data['errors'] = $this->getErrors();

        $this->view->render('admin_categories', $data);
    }

    public function actionOne(Request $request)
    {
        $id = $request->getParam('id');

        if (!$this->mapper->checkExists($id)) {
            CustomRedirect::redirect('404');
        }

        $data['errors'] = $this->getErrors();
        $data['info'] = $this->characteristics->getCharacteristicsByCategory($id);
        $data['title'] = 'Category info';

        $this->view->render('admin_category', $data);
    }
}

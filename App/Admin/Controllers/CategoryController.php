<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 26.01.19
 * Time: 10:47
 */

namespace App\Admin\Controllers;


use App\Admin\Main\AdminView;
use App\Admin\Mappers\CategoryMapper;
use Core\Controller;
use Core\CustomRedirect;
use Core\Request;

class CategoryController extends Controller
{
    public $categoryCharacteristics;

    public function __construct()
    {
        $this->mapper = new CategoryMapper();
        $this->categoryCharacteristics = new CategoryCharacteristicController();

        $this->view = new AdminView();
    }

    public function getErrors(string $action)
    {
        $errors = [];

        if ($this->mapper->checkAction($action)) {
            $errors = $this->mapper->checkForErrors($action);
        }

        return $errors;
    }

    public function getCategories()
    {
        return $this->mapper->getAllCategories();
    }

    public function actionInsert()
    {
        if (!isset($_POST['insert'])) {
            header("Location: /admin");
        }

        $this->mapper->insertCategoryInfo();

        header("Location: /admin/categories");
    }

    public function actionDelete()
    {
        if (!isset($_POST['delete'])) {
            header("Location: /admin");
        }

        $this->mapper->deleteCategoryInfo($_POST['delete']);

        header("Location: /admin/categories");
    }

    public function actionUpdate()
    {
        if (!isset($_POST['update'])) {
            header("Location: /admin");
        }

        $this->mapper->updateCategoryInfo($_POST['update']);

        header("Location: /admin/categories");
    }

    public function actionOne(Request $request)
    {
        $id = $request->getParam('id');

        if (!$this->mapper->checkExists($id)) {
            CustomRedirect::redirect('404');
        }

        $data['info'] = $this->categoryCharacteristics->getCharacteristicsByCategory($id);
        $data['title'] = 'Category info';
        $this->view->render('admin_category', $data);
    }

    public function actionAll()
    {
        $data['categories'] = $this->getCategories();
        $data['title'] = 'All categories';

        $this->view->render('admin_categories', $data);
    }
}

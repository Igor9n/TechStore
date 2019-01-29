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

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->mapper = new CategoryMapper();
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
}

<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 26.01.19
 * Time: 15:18
 */

namespace App\Admin\Controllers;

use App\Admin\Mappers\CategoryCharacteristicMapper;
use App\Classes\Session;
use Core\Controller;


class CategoryCharacteristicController extends Controller
{
    public function __construct()
    {
        $this->mapper = new CategoryCharacteristicMapper();
    }

    public function getCharacteristicsByCategory(int $id)
    {
        return $this->mapper->getCharacteristicsByCategory($id);
    }

    public function getErrors(string $action)
    {
        $errors = [];

        if ($this->mapper->checkAction($action)) {
            $errors = $this->mapper->checkForErrors($action);
        }

        if (!empty($errors['list'])) {
            Session::set('errors', $errors);
        }
    }

    public function actionInsert()
    {
        if (!isset($_POST['insert'])) {
            header("Location: /admin");
        }


        if (!Session::check('errors')) {
            $this->mapper->insertCharacteristicInfo();
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function actionUpdate()
    {
        if (!isset($_POST['update'])) {
            header("Location: /admin");
        }

        if (!Session::check('errors')) {
            $this->mapper->updateCharacteristicInfo($_POST['update']);
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function actionDelete()
    {
        if (!isset($_POST['delete'])) {
            header("Location: /admin");
        }

        $this->mapper->deleteCharacteristicInfo($_POST['delete']);

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

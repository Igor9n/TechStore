<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 26.01.19
 * Time: 15:18
 */

namespace App\Admin\Controllers;

use App\Admin\Mappers\CategoryCharacteristicMapper;
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

    public function actionInsert()
    {
        if (!isset($_POST['insert'])) {
            header("Location: /admin");
        }

        $this->mapper->insertCharacteristicInfo();

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

    public function actionUpdate()
    {
        if (!isset($_POST['update'])) {
            header("Location: /admin");
        }

        $this->mapper->updateCharacteristicInfo($_POST['update']);

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
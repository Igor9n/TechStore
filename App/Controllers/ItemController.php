<?php
namespace App\Controllers;

use App\Classes\Session;
use App\Core\Route;
use App\Mappers\ItemMapper;
use App\Models\ItemModel;

class ItemController extends MainController
{
    public function __construct() {
        parent::__construct();
        $this->model = new ItemModel();
        $this->mapper = new ItemMapper();
    }

    public function getItemInfo($id) {
        return $this->mapper->getObject($id);
    }

    public function getFiveItems() {
        return $this->mapper->getArray($this->model->getLastFiveItemsIds());
    }

    public function getAllItems() {
        return $this->mapper->getArray($this->model->getItemsIdList());
    }

    public function actionView($id) {
        if(Route::checkExist($id,$this->model->getItemsSTList())){
            $data['info'] = $this->getItemInfo($id);
            $data['title'] = $data['info']->title;
            $this->view->generate('template.php', 'item.php', $data);
        } else {
            Route::ErrorPage404();
        }
    }
    public function actionAdd(){
        $id = (int) $_GET['id'];
        if (isset($id)){
            Session::anotherSessionStart();
            $_SESSION['item'] = $this->getItemInfo($id);
            header("Location: /cart/add");
        } else {
            header("Location: /");
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 24.12.18
 * Time: 9:40
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Mappers\CartMapper;
use App\Models\CartModel;

class CartController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->model = new CartModel();
        $this->mapper = new CartMapper();
    }

    public function getCartInfo($item) {
        return $this->mapper->getObject($item);
    }

    public function addInfoForOrder($cart) {
        $this->mapper->addAddressInfo($cart, [
            $_POST['city'],
            $_POST['address'],
            $_POST['house'],
            $_POST['apartment'],
            $_POST['zip']
        ]);
        $this->mapper->addPersonalInfo($cart, [
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['phone'],
            $_POST['email']
        ]);
    }

    public function actionAdd() {
        if (isset($_SESSION['item'])) {
            $item = $_SESSION['item'];
            $uri = "/item/view/" . $item->serviceTitle;
            if (isset($_SESSION['cart'])) {
                if (isset($_SESSION['cart']->itemsArray[$item->id])) {
                    $this->mapper->changeItemCount('plus',$_SESSION['cart'],$item);
                } else {
                    $this->mapper->addItemToCart($_SESSION['cart'], $item);
                }
            } else {
                $_SESSION['cart'] = $this->getCartInfo($item);
                unset($_SESSION['item']);
            }
            unset($_SESSION['item']);
            header("Location: $uri");
        } else {
            header("Location: /");
        }
    }

    public function actionView() {
        $data['title'] = 'Cart';
        if (!empty($_SESSION['cart']->itemsArray)){
            $data['cart'] = $_SESSION['cart'];
        }
        $this->view->generate('template.php', 'cart.php', $data);
    }
    public function actionCheckout() {
        $data['title'] = 'Cart';
        if (!empty($_SESSION['cart']->itemsArray)){
            $data['cart'] = $_SESSION['cart'];
            if (isset($_SESSION['ordered'])) {
                $data['ordered'] = true;
                $data['orderNumber'] = $_SESSION['orderNumber'];
                unset($_SESSION['ordered']);
                unset($_SESSION['orderNumber']);
                unset($_SESSION['cart']);
            } else {
                if (isset($_SESSION['errors'])) {
                    $data['errors'] = $_SESSION['errors'];
                    unset($_SESSION['errors']);
                }
                $_SESSION['orderRang'] = 0;
            }
        }
        $this->view->generate('template.php', 'checkout.php', $data);
    }
    public function actionClean() {
        unset($_SESSION['cart']);
        header("Location: /cart/view");
    }
    public function actionDelete() {
        $id = $_GET['id'];
        unset($_SESSION['cart']->itemsArray[$id]);
        $_SESSION['cart']->totalPrice = $_SESSION['cart']->getTotalPrice($_SESSION['cart']->itemsArray);
        header("Location: /cart/view");

    }
    public function actionPlus() {
        $id = $_GET['id'];
        $this->mapper->changeItemCount('plus', $_SESSION['cart'],$_SESSION['cart']->itemsArray[$id]['info']);
        header("Location: /cart/view");
    }
    public function actionMinus() {
        $id = $_GET['id'];
        $this->mapper->changeItemCount('minus', $_SESSION['cart'],$_SESSION['cart']->itemsArray[$id]['info']);
        header("Location: /cart/view");
    }
    public function actionOrder() {
        if ($_SESSION['orderRang'] === 0) {
            $this->addInfoForOrder($_SESSION['cart']);
            $info = $_SESSION['cart'];
            $errors = $this->mapper->checkForErrors($info);
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /cart/checkout");
            } else {
                $_SESSION['orderRang'] = 1;
                $_SESSION['ordered'] = true;
                $_SESSION['orderNumber'] = $this->mapper->submitOrder($info);
                header("Location: /cart/checkout");
            }
        } else {
            header("Location: /category/view/all");
        }
    }
}
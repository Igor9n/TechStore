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

    public function getCartInfo() {
        return $this->mapper->getObject();
    }

    public function addInfoForOrder($cart) {
        var_dump($cart);
        $cart->fillPersonalInfo(
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['phone'],
            $_POST['email']
        );
        $cart->fillAddressInfo(
            $_POST['city'],
            $_POST['address'],
            $_POST['house'],
            $_POST['apartment'],
            $_POST['zip']
        );
        return $cart;
    }
    public function actionView() {
        $data['title'] = 'Cart';
        if (!empty($_SESSION['cart'])){
            $data['cart'] = $this->getCartInfo();
            $_SESSION['cartObject'] = $data['cart'];
        }
        $this->view->generate('template.php', 'cart.php', $data);
    }
    public function actionCheckout() {
        $data['title'] = 'Cart';
        if (!empty($_SESSION['cart'])){
            $data['cart'] = $_SESSION['cartObject'];
            if (isset($_POST['ordered'])) {
                $data['ordered'] = true;
                $data['orderNumber'] = $_POST['orderNumber'];
                foreach ($_POST as $key => $var){
                    unset($_POST[$key]);
                }
                unset($_SESSION['cart']);
            } else {
                if (isset($_POST['errors'])) {
                    $data['errors'] = $_POST['errors'];
                    unset($_POST['errors']);
                }
                $_SESSION['orderRang'] = 0;
            }
        }
        $this->view->generate('template.php', 'checkout.php', $data);
    }
    public function actionClean() {
        unset($_SESSION['cart']);
        unset($_SESSION['cartObject']);
        header("Location: /cart/view");
    }
    public function actionDelete() {
        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]);
        header("Location: /cart/view");

    }
    public function actionPlus() {
        $id = $_GET['id'];
        $_SESSION['cart'][$id]['count']++;
        header("Location: /cart/view");
    }
    public function actionMinus() {
        $id = $_GET['id'];
        $_SESSION['cart'][$id]['count']--;
        header("Location: /cart/view");
    }
    public function actionOrder() {
        if ($_SESSION['orderRang'] === 0) {
            $info = $this->addInfoForOrder($_SESSION['cartObject']);
            $errors = $this->model->checkForErrors($info);
            if (!empty($errors)) {
                $_POST['errors'] = $errors;
                $this->actionCheckout();
            } else {
                $_SESSION['orderRang'] = 1;
                $_POST['ordered'] = true;
                $_POST['orderNumber'] = $this->model->submitOrder($info);
                $this->actionCheckout();
            }
        } else {
            header("Location: /category/view/all");
        }
    }

}
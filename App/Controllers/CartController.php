<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 24.12.18
 * Time: 9:40
 */

namespace App\Controllers;

use App\Classes\Session;
use Core\Controller;
use App\Mappers\CartMapper;
use App\Models\CartModel;

class CartController extends Controller
{
    public $cart;

    public function __construct()
    {
        parent::__construct();
        $this->model = new CartModel();
        $this->mapper = new CartMapper();
        $this->cart = Session::get('cart');
    }


    public function actionAdd()
    {
        if (!Session::check('item')) {
            header("Location: /");
        }

        $newAdded = 0;
        $item = Session::get('item');

        if (!Session::check('cart')) {
            Session::set('cart', $this->mapper->getObject($item));
            $newAdded = 1;
        }

        if (isset($this->cart->itemsArray[$item->id]) && $newAdded === 0) {
            $this->mapper->changeItemCount('plus', $this->cart, $item);
        } else {
            $this->mapper->addItemToCart($this->cart, $item);
        }

        Session::unset('item');

        header("Location: /item/view/" . $item->serviceTitle);
    }

    public function actionView()
    {
        $data['title'] = 'Cart';

        if (!empty($this->cart->itemsArray)) {
            $data['cart'] = $this->cart;
        }

        $this->view->generate('template.php', 'cart.php', $data);
    }

    public function actionCheckout()
    {
        $data['title'] = 'Cart';

        if (!empty($this->cart)) {
            $data['cart'] = $this->cart;

            if (Session::check('ordered')) {
                $data['ordered'] = true;
                $data['orderNumber'] = Session::get('orderNumber');

                Session::unset('ordered');
                Session::unset('orderNumber');
                Session::unset('cart');
            } else {
                if (Session::check('errors')) {
                    $data['errors'] = Session::get('errors');
                    Session::unset('errors');
                }
                Session::set('orderRang', 0);
            }
        }
        $this->view->generate('template.php', 'checkout.php', $data);
    }

    public function actionClean()
    {
        Session::unset('cart');
        header("Location: /cart/view");
    }

    public function actionDelete()
    {
        $id = $_GET['id'];

        unset($_SESSION['cart']->itemsArray[$id]);
        $this->cart->totalPrice = $this->cart->getTotalPrice($this->cart->itemsArray);
        header("Location: /cart/view");
    }

    public function actionPlus()
    {
        $id = $_GET['id'];

        $this->mapper->changeItemCount('plus', $this->cart, $this->cart->itemsArray[$id]['info']);
        header("Location: /cart/view");
    }

    public function actionMinus()
    {
        $id = $_GET['id'];

        $this->mapper->changeItemCount('minus', $this->cart, $this->cart->itemsArray[$id]['info']);
        header("Location: /cart/view");
    }

    public function actionOrder()
    {
        if (Session::get('orderRang') === 1) {
            header("Location: /category/view/all");
        }

        $this->mapper->addInfoForOrder($this->cart);
        $info = $this->cart;
        $errors = $this->mapper->checkForErrors($info);

        if (!empty($errors)) {
            Session::set('errors', $errors);
        } else {
            Session::set('orderRang', 1);
            Session::set('ordered', true);
            Session::set('orderNumber', $this->mapper->submitOrder($info));
        }
        header("Location: /cart/checkout");
    }
}
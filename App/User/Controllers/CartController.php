<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 24.12.18
 * Time: 9:40
 */

namespace App\User\Controllers;

use App\User\Data\{Item, Cart};
use Core\{Session, Controller, CustomRedirect, Request};
use App\User\Mappers\CartMapper;
use App\User\Models\CartModel;

class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new CartModel();
        $this->mapper = new CartMapper();
    }

    public function actionAdd()
    {
        if (!Session::check('item')) {
            CustomRedirect::redirect('cart/view');
        }

        $newAdded = 0;
        /**
         * @var $item Item
         */
        $item = Session::get('item');
        if (!Session::check('cart')) {
            Session::set('cart', $this->mapper->getObject($item));
            $newAdded = 1;
        }
        /**
         * @var $cart Cart
         */
        $cart = Session::get('cart');
        if (isset($cart->itemsArray[$item->id]) && $newAdded === 0) {
            $this->mapper->changeItemCount('plus', $cart, $item);
        } else {
            $this->mapper->addItemToCart($cart, $item);
        }

        Session::unset('item');

        CustomRedirect::back();
    }


    public function actionCheckout()
    {
        $data['title'] = 'Cart';

        $data['cart'] = Session::get('cart');

        if (Session::check('ordered')) {
            $data['ordered'] = true;
            $data['orderNumber'] = Session::get('orderNumber');

            Session::unset(['ordered', 'orderNumber', 'cart']);
        } else {
            if (Session::check('errors')) {
                $data['errors'] = Session::get('errors');
                Session::unset('errors');
            }
        }
        $this->view->initView('checkout', $data);
    }

    public function actionClean()
    {
        Session::unset('cart');
        CustomRedirect::back();
    }

    /**
     * @param Request $request
     */
    public function actionDelete(Request $request)
    {
        $id = $request->getPostParam('id');

        Session::unset("cart.itemsArray.$id");
        /**
         * @var $cart Cart
         */
        $cart = Session::get('cart');
        $cart->totalPrice = $cart->getTotalPrice($cart->itemsArray);

        CustomRedirect::back();
    }

    public function actionCount(Request $request)
    {
        $id = $request->getPostParam('id');
        $key = $request->getActionKey();
        /**
         * @var $cart Cart
         */
        $cart = Session::get('cart');
        $this->mapper->changeItemCount($key, $cart, $cart->itemsArray[$id]['info']);
        CustomRedirect::back();
    }

    /**
     * @param Request $request
     */
    public function actionOrder(Request $request)
    {
        if (!$request->getPostParam('order')) {
            CustomRedirect::redirect('cart/view');
        }

        $cart = Session::get('cart');
        $this->mapper->addInfoForOrder($cart, $request);
        $errors = $this->mapper->checkForErrors($cart);

        if (!empty($errors)) {
            Session::set('errors', $errors);
        } else {
            Session::set([
                'ordered' => true,
                'orderNumber' => $this->mapper->submitOrder($cart)
            ]);
        }
        CustomRedirect::back();
    }

    public function actionView()
    {
        $data['title'] = 'Cart';

        $data['cart'] = Session::get('cart');

        $this->view->initView('cart', $data);
    }
}

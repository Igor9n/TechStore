<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 24.12.18
 * Time: 9:40
 */

namespace App\User\Controllers;

use App\Classes\Session;
use App\User\Data\Item;
use Core\Controller;
use App\User\Mappers\CartMapper;
use App\User\Models\CartModel;
use Core\CustomRedirect;
use Core\Request;

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
        $item = Session::get('item');
        if (!Session::check('cart')) {
            Session::set('cart', $this->mapper->getObject($item));
            $newAdded = 1;
        }

        if (isset(Session::get('cart')->itemsArray[$item->id]) && $newAdded === 0) {
            $this->mapper->changeItemCount('plus', Session::get('cart'), $item);
        } else {
            $this->mapper->addItemToCart(Session::get('cart'), $item);
        }

        Session::unset('item');

        CustomRedirect::redirect('item/view?id=' . $item->serviceTitle);
    }


    public function actionCheckout()
    {
        $data['title'] = 'Cart';

        $data['cart'] = Session::get('cart');

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
        }
        $this->view->initView('checkout', $data);
    }

    public function actionClean()
    {
        Session::unset('cart');
        CustomRedirect::back();
    }

    public function actionDelete(Request $request)
    {
        $id = $request->getPostParam('id');

        unset($_SESSION['cart']->itemsArray[$id]);
        Session::get('cart')->totalPrice = Session::get('cart')->getTotalPrice(Session::get('cart')->itemsArray);

        CustomRedirect::back();
    }

    public function actionCount(Request $request)
    {
        $id = $request->getPostParam('id');
        $key = $request->getActionKey();

        $this->mapper->changeItemCount($key, Session::get('cart'), Session::get('cart')->itemsArray[$id]['info']);
        CustomRedirect::back();
    }

    public function actionOrder(Request $request)
    {
        if (!$request->getPostParam('order')) {
            CustomRedirect::redirect('cart/view');
        }

        $this->mapper->addInfoForOrder(Session::get('cart'));
        $info = Session::get('cart');
        $errors = $this->mapper->checkForErrors($info);

        if (!empty($errors)) {
            Session::set('errors', $errors);
        } else {
            Session::set('ordered', true);
            Session::set('orderNumber', $this->mapper->submitOrder($info));
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

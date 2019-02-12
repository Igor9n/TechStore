<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 04.02.19
 * Time: 13:59
 */

namespace App\Admin\Main;


use Core\Session;
use Core\Controller;
use Core\CustomRedirect;
use Core\Request;

class MainController extends Controller
{
    public $characteristics;

    public function __construct()
    {
        parent::__construct();
        $this->view = new MainView();
        $this->mapper = new MainMapper();
    }

    protected function getErrors()
    {
        $errors = [];

        if (Session::check('errors')) {
            $errors = Session::get('errors');
            Session::unset('errors');
        }

        return $errors;
    }

    public function chooseMapper(Request $request)
    {
        $mapper = $this->mapper->chooseMapper($request->getPostParam('key'));

        if (!$mapper) {
            CustomRedirect::redirect('404');
        }

        $errors = [];
        if ($request->getPostParam('action') !== 'delete') {
            $errors = $this->$mapper->checkForErrors($request->getPostParams());
        }

        if (!empty($errors['list'])) {
            Session::set('errors', $errors);
        } else {
            $method = strtolower(substr($request->getActionName(), 6));
            $this->$mapper->$method($request->getPostParams());
        }

        CustomRedirect::back();
    }
}

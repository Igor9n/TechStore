<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 26.01.19
 * Time: 10:47
 */

namespace App\Admin\Controllers;


use App\Admin\Main\AdminView;
use App\Admin\Mappers\CategoryCharacteristicMapper;
use App\Admin\Mappers\CategoryMapper;
use App\Classes\Session;
use Core\Controller;
use Core\CustomRedirect;
use Core\Request;

class CategoryController extends Controller
{
    public $characteristics;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new CategoryMapper();
        $this->characteristics = new CategoryCharacteristicMapper();

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

    public function actionDelete(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionUpdate(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionInsert(Request $request)
    {
        $this->chooseMapper($request);
    }

    public function actionAll()
    {
        $data['categories'] = $this->getCategories();
        $data['title'] = 'All categories';

        if (Session::check('errors')) {
            $data['errors'] = Session::get('errors');
            Session::unset('errors');
        }

        $this->view->render('admin_categories', $data);
    }

    public function actionOne(Request $request)
    {
        $id = $request->getParam('id');

        if (!$this->mapper->checkExists($id)) {
            CustomRedirect::redirect('404');
        }

        if (Session::check('errors')) {
            $data['errors'] = Session::get('errors');
            Session::unset('errors');
        }

        $data['info'] = $this->characteristics->getCharacteristicsByCategory($id);
        $data['title'] = 'Category info';

        $this->view->render('admin_category', $data);
    }
}

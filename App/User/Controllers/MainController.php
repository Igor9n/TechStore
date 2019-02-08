<?php

namespace App\User\Controllers;

use Core\{View, Controller};


class MainController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view = new View();
    }

    public function actionIndex()
    {
        $data['title'] = 'Main page';
        $this->view->initView('index', $data);
    }

    public function actionAbout()
    {
        $data['title'] = 'Our company';
        $this->view->initView('about', $data);
    }

    public function actionVacancies()
    {
        $data['title'] = 'Vacancies';
        $this->view->initView('vacancies', $data);
    }

    public function actionDelivery()
    {
        $data['title'] = 'Delivery';
        $this->view->initView('delivery', $data);
    }

    public function actionPayment()
    {
        $data['title'] = 'Payment types';
        $this->view->initView('payment', $data);
    }

    public function actionGuarantee()
    {
        $data['title'] = 'Guarantee';
        $this->view->initView('guarantee', $data);
    }

    public function actionContact()
    {
        $data['title'] = 'Our contacts';
        $this->view->initView('contact', $data);
    }
}
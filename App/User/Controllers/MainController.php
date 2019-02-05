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
        $this->view->render('index', $data);
    }

    public function actionAbout()
    {
        $data['title'] = 'Our company';
        $this->view->render('about', $data);
    }

    public function actionVacancies()
    {
        $data['title'] = 'Vacancies';
        $this->view->render('vacancies', $data);
    }

    public function actionDelivery()
    {
        $data['title'] = 'Delivery';
        $this->view->render('delivery', $data);
    }

    public function actionPayment()
    {
        $data['title'] = 'Payment types';
        $this->view->render('payment', $data);
    }

    public function actionGuarantee()
    {
        $data['title'] = 'Guarantee';
        $this->view->render('guarantee', $data);
    }

    public function actionContact()
    {
        $data['title'] = 'Our contacts';
        $this->view->render('contact', $data);
    }
}
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
        $this->view->generate('template.php', 'index.php', $data);
    }

    public function actionAbout()
    {
        $data['title'] = 'Our company';
        $this->view->generate('template.php', 'about.php', $data);
    }

    public function actionVacancies()
    {
        $data['title'] = 'Vacancies';
        $this->view->generate('template.php', 'vacancies.php', $data);
    }

    public function actionDelivery()
    {
        $data['title'] = 'Delivery';
        $this->view->generate('template.php', 'delivery.php', $data);
    }

    public function actionPayment()
    {
        $data['title'] = 'Payment types';
        $this->view->generate('template.php', 'payment.php', $data);
    }

    public function actionGuarantee()
    {
        $data['title'] = 'Guarantee';
        $this->view->generate('template.php', 'guarantee.php', $data);
    }

    public function actionContact()
    {
        $data['title'] = 'Our contacts';
        $this->view->generate('template.php', 'contact.php', $data);
    }

}
<?php
namespace App\Controllers;

use App\Core\Controller;

class MainController extends Controller
{

    public function __construct(){
        parent::__construct();
        $this->view = new \App\Core\View();
    }
    public function actionIndex(){
        $data['title'] = 'Main page';
        $this->view->generate('template.php','index.php', $data);
    }
    public function actionAbout(){
        $data['title'] = 'Our company';
        $this->view->generate('template.php', 'about.php', $data);
    }
    public function actionVacancies(){
        $data['title'] = 'Vacancies';
        $this->view->generate('template.php', 'vacancies.php', $data);
    }
}
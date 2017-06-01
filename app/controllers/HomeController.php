<?php

namespace app\controllers;

use app\models\Home;

class HomeController extends App
{


    public function indexAction()
    {
        $model = new Home();
        $departaments = $model->findOne(2);
        $title = 'Home controller, test function';
        $this->view('index', compact('title', 'departaments'));
    }

    public function testAction()
    {
        $title = 'Home controller, test function';
        $this->view('index', compact('title'));
    }
}
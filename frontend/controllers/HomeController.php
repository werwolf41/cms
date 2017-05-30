<?php

namespace frontend\controllers;


use app\engine\Registry;
use app\lib\Controller;

class HomeController extends Controller
{


    public function indexAction()
    {
        $this->testAction();
    }

    public function testAction()
    {
        $title = 'Home controller, test function';
        $this->view('index', compact('title'));
    }
}
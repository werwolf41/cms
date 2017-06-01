<?php

namespace app\controllers;


class HomeController extends App
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
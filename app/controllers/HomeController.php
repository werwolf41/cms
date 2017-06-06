<?php

namespace app\controllers;

use app\models\Home;

class HomeController extends App
{


    public function indexAction()
    {
//        $model = new Home();
        $departaments = \vendor\core\App::$app->cache->getCache('departaments', 'all');
        if(!$departaments){
            $departaments = Home::all();
            \vendor\core\App::$app->cache->setCache('departaments', 'all', $departaments, 3600*24*10);
        }

        $mailer =  \vendor\core\App::$app->mailer;
        $mailer->setSubject("Test Email");
        $mailer->setRecipient(["werwolf41@gmail.com" => "Your Name"]);
        $mailer->addContent("Hello");
        $mailer->send();
        $title = 'Home controller, test function';
        $this->view('index', compact('title', 'departaments'));

    }

    public function testAction()
    {
        $title = 'Home controller, test function';
        $this->view('index', compact('title'));
    }
}
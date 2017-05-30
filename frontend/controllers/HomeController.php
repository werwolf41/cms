<?php

namespace frontend\controllers;


use app\engine\Registry;

class HomeController
{


    public function indexAction()
    {
        echo 'Home controller';
    }

    public function testAction($args=[])
    {
        echo 'Home controller, test function';
        foreach ($args as $key => $value){
            echo '<br/>'.$key.' = '.$value;
        }
    }
}
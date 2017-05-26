<?php

namespace frontend\controllers;


use app\engine\Registry;

class Home
{
    public function __construct(Registry $registry)
    {
    }

    public function index()
    {
        echo 'Home controller';
    }

    public function test($args=[])
    {
        echo 'Home controller, test function';
        foreach ($args as $key => $value){
            echo '<br/>'.$key.' = '.$value;
        }
    }
}
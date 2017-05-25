<?php
namespace app\engine;


class Route
{
    /**
     * @var className
     */
    private $controller;
    /**
     * @var function
     */
    private $action;
    /**
     * @var array
     */
    private $args=[];

    public function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');
        if($position) {
            $url = substr($url, 0, $position);
            $this->setArgs();
        }
    }

    private function setArgs(){
        $args = explode('&',$_SERVER['QUERY_STRING']);
        foreach ($args as $value){
            $ar = explode('=', $value);
            $this->args[$ar[0]] = $ar[1];
        }
    }
}
<?php

namespace core\lib;

abstract Class Controller
{
    /**
     * @var string
     */
    protected $layout = '';

    /**
     * @var string
     */
    protected $view = '';

    /**
     * @var string
     */
    protected $templateDir='';



    /**
     * вызывает метод view класса View
     * @param $view
     * @param array $data
     */
    public function view($view, $data=[]){
        $vObj = new View($this->layout, $this->templateDir);
        $vObj->render($view, $data);
    }
}
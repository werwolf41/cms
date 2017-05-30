<?php

namespace app\lib;


use app\engine\Registry;

class View
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var string
     */
    private $layout='';

    /**
     * @var string
     */
    private $view='';

    /**
     * @var string
     */
    private $templateDir='';

    public function __construct(Registry $registry,  $view='', $layout='', $templateDir='')
    {
        $this->registry = $registry;
        $config = $this->registry->getRegistry('config');
        $this->layout = $layout ?: $config['templates']['layout'];
        $this->templateDir = $templateDir ?: $config['templates']['vievs'];
        $this->view = $view ?: $this->registry->getRegistry('action');
    }

    public function render(){

    }
}
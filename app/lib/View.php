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
        $route = $this->registry->getRegistry('route');
        $this->templateDir.='/'.$route['controller'];
        $this->view = $view ?: $route['action'];
    }

    public function render()
    {
        $web = $this->registry->getRegistry('config');
        $template = WEBDIR . '/views/'.$this->templateDir.'/'.$this->view.'.php';
        if (file_exists($template)){
            include $template;
        } else {
            echo "Файл шаблона {$template} не найден";
        }
    }
}
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
    private $templateDir='';

    /**
     * View constructor.
     * @param Registry $registry
     * @param string $layout
     * @param string $templateDir
     */
    public function __construct(Registry $registry, $layout='', $templateDir='')
    {
        $this->registry = $registry;
        $config = $this->registry->getRegistry('config');
        $this->layout = $layout ?: $config['templates']['layout'];
        $this->templateDir = $templateDir ?: $config['templates']['vievs'];
    }

    /**
     * вывод шаблона
     * @param $view
     * @param array $data
     */
    public function render($view, $data=[])
    {
        $route = $this->registry->getRegistry('route');
        $template = WEBDIR."/views/{$this->templateDir}/{$route['controller']}/{$view}.php";
        $layout = WEBDIR . "/views/{$this->templateDir}/{$this->layout}.php";

        if (file_exists($template) && file_exists($layout)){
            extract($data);
            ob_start();
            
            include $template;

            $content = ob_get_contents();
            
            ob_get_clean();

            include $layout;

        } else {
//            TODO Вывод ошибки
            echo "Файл шаблона {$template} или {$layout} не найден";
        }
    }
}
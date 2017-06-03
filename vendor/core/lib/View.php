<?php


namespace core\lib;


use core\Route;

class View
{
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
    public function __construct($layout='', $templateDir='')
    {
        $config = require_once CONFIG . '/templates.php';
        $this->layout = $layout ?: $config['layout'];
        $this->templateDir = $templateDir ?: $config['templateDir'];
    }

    /**
     * вывод шаблона
     * @param $view
     * @param array $data
     */
    public function render($view, $data=[])
    {
        $route = Route::getRote();
        $template = APP."/views/{$this->templateDir}/{$route['controller']}/{$view}.php";
        $layout = APP . "/views/{$this->templateDir}/{$this->layout}.php";

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
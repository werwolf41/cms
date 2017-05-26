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

    /**
     * @var string
     */
    private $app = '';

    /**
     * @var Registry
     */
    private  $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
        $config = $this->registry->getRegistry(config);
        $this->app = $config['app'];

        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');
        if($position) {
            $url = substr($url, 0, $position);
            $this->setArgs();
        }
        if($url == '/'){
            $this->controller = '\\'.$this->app.'\\'.'controllers\\Home';
            $this->action = 'index';
        }else{
            $url = substr($url, 1);
            $urlparts = explode('/', $url);
            $pach = __Dir__.'/../../'.$this->app.'/controllers/';
            $controller = '\\'.$this->app.'\\controllers\\' ;
            foreach ($urlparts as $part){
                if(empty($this->controller) && is_file($pach.lcfirst($part).'.php'))
                {
                    $this->controller = $controller.lcfirst($part);
                    continue;
                }
                else if(empty($this->controller) && !is_file($pach.lcfirst($part).'.php'))
                {
                    $pach .= $part . '/';
                    $controller .= $part . '\\';
                    continue;
                }
                elseif(!empty($this->controller))
                {
                    $this->action = $part;
                    break;
                }

            }
        }
        $this->redirect();
    }

    private function setArgs(){
        $args = explode('&',$_SERVER['QUERY_STRING']);
        foreach ($args as $value){
            $ar = explode('=', $value);
            $this->args[$ar[0]] = $ar[1];
        }
    }

    public function redirect(){
       $controller =  new $this->controller ($this->registry);
       $action = $this->action;
       $controller->$action($this->args);
    }

}
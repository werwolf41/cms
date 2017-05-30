<?php
namespace app\engine;


class Route
{
    /**
     * @var Registry
     */
    private $regestry;
    /**
     * таблица маршрутов
     * @var array
     */
    private  $routes = [];

    /**
     * текущий маршрут
     * @var array
     */
    private  $route = [];

    public function __construct($registry)
    {
        $this->regestry = $registry;

        $config = $this->regestry->getRegistry('config');

        foreach ($config['routes'] as $k => $v){
            if (is_array($v)){
               $this->setRouters($k, $v);
            }else{
                $this->setRouters($k);
            }
        }
    }

    /**
     * добавляет маршрут в таблицу маршрутов
     *
     * @param string $regexp регулярное выражение маршрута
     * @param array $route маршрут ([controller, action, params])
     */
    public  function setRouters ($regexp, $route=[])
    {
        $this->routes[$regexp]=$route;
    }

    /**
     * возвращает таблицу маршрутов
     *
     * @return array
     */
    public  function getRoutes()
    {
        return $this->routes;
    }

    /**
     * возвращает текущий маршрут (controller, action, [params])
     *
     * @return array
     */
    public  function getRote()
    {
        return $this->route;
    }

    /**
     * ищет URL в таблице маршрутов
     * @param string $url входящий URL
     * @return bool
     */
    public  function machRote($url)
    {
        foreach ($this->routes as $patern => $route){
            if (preg_match("#$patern#i", $url, $maches)){
                foreach ($maches as $k => $v){
                    if (is_string($k)){
                        $route[$k] = $v;
                    }
                }
                if(!(isset($route['action']))){
                    $route['action'] = 'index';
                }
                $route['controller'] = $this->upperCamelCase($route['controller']);
                $this->route = $route;
                return true;
            }
        }
        return false;
    }

    public  function dispache($url){
        $url = $this->removeGetParams($url);
        if ($this->machRote($url)){
            $controller = WEB .'\\controllers\\'. $this->route['controller'].'Controller';

            if (class_exists($controller)){
                $cObg = new $controller ($this->regestry);
                $action = $this->route['action'].'Action';
                if (method_exists($cObg, $action)){
                    $cObg->$action();
                }else{
                    http_response_code(404);
                    echo '404 error <br>';
                    echo "Метод <b>$controller::$action</b> не найден";
                }
            }else{
                http_response_code(404);
                echo '404 error <br>';
                echo "Контроллер <b>$controller</b> не найден";
            }
        }else{
            http_response_code(404);
            echo '404';
        }
    }

    public  function upperCamelCase($name){
        $name = str_replace('-', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }

    private  function removeGetParams($url){
        if ($url){
            $params = explode('&', $url, 2);
            if(false === strpos($params[0], '=')){
                return $params[0];
            } else {
                return '/';
            }
        }
    }
}
<?php
namespace app\engine;


class Route
{
    /**
     * таблица маршрутов
     * @var array
     */
    private static $routes = [];

    /**
     * текущий маршрут
     * @var array
     */
    private static $route = [];

    /**
     * добавляет маршрут в таблицу маршрутов
     *
     * @param string $regexp регулярное выражение маршрута
     * @param array $route маршрут ([controller, action, params])
     */
    public static function setRouters ($regexp, $route=[])
    {
        self::$routes[$regexp]=$route;
    }

    /**
     * возвращает таблицу маршрутов
     *
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * возвращает текущий маршрут (controller, action, [params])
     *
     * @return array
     */
    public static function getRote()
    {
        return self::$route;
    }

    /**
     * ищет URL в таблице маршрутов
     * @param string $url входящий URL
     * @return bool
     */
    public static function machRote($url)
    {
        foreach (self::$routes as $patern => $route){
            if (preg_match("#$patern#i", $url, $maches)){
                foreach ($maches as $k => $v){
                    if (is_string($k)){
                        $route[$k] = $v;
                    }
                }
                if(!(isset($route['action']))){
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispache($url){
        $url = self::removeGetParams($url);
        if (self::machRote($url)){
            $controller = WEB .'\\controllers\\'. self::$route['controller'].'Controller';

            if (class_exists($controller)){
                $cObg = new $controller;
                $action = self::$route['action'].'Action';
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

    public static function upperCamelCase($name){
        $name = str_replace('-', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }

    private static function removeGetParams($url){
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
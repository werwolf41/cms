<?php

namespace vendor\core;


class Registry
{
    /**
     * @var array
     */
    protected static $objects = [];

    /**
     * @var self
     */
    protected static $instance ;

    /**
     * Registry constructor.
     */
    private function __construct()
    {
        $config =  require CONFIG . '/config.php';
        foreach ($config['components'] as $name => $component) {
            if (is_array($component)){
                self::$objects[$name] = new $component['class']($component['config']);
            } else {
                self::$objects[$name] = new $component;
            }
        }
    }

    /**
     * Registry instance.
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if(is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
    }

    /**
     * @param $name
     * @param $object
     */
    public function __set($name, $object)
    {
        self::$objects[$name] = new $object;
    }

    public function getList(){
        echo '<pre>';
        var_dump(self::$objects);
        echo '</pre>';
    }
}
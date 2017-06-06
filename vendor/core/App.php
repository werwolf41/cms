<?php

namespace vendor\core;


class App
{
    /**
     * @var Registry::$objects
     */
    public static $app;

    /**
     * App constructor.
     */
    public function __construct()
    {
        self::$app = Registry::instance();
    }

}
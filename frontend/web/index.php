<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

use app\engine\Registry;
use app\engine\Route;

require_once __DIR__."/../../vendor/autoload.php";

//Registry
$registry = new Registry();

//config
$config = require_once __DIR__.'/../config/config.php';
$registry->setRegistry('config', $config);

//route
new Route($registry);

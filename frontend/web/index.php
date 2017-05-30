<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use app\engine\Registry;
use app\engine\Route;

define('WEBDIR', dirname(__DIR__));
define('APP', dirname(dirname(__DIR__)).'/app');
define('COMMON', dirname(dirname(__DIR__)).'/common');

//tmp
require __DIR__."/../../app/lib/functions.php";

$url = $_SERVER['REQUEST_URI'];

//autoload
require_once __DIR__."/../../vendor/autoload.php";

//Registry
$registry = new Registry();

//config
$config = require_once __DIR__.'/../config/config.php';
$registry->setRegistry('config', $config);
define('WEB', '\\'.$config['web']);

//route
$route  = new Route($registry);
$route->dispache($url);

$registry;
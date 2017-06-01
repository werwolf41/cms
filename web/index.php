<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use core\Route;
define('ROOT_FOLDER', dirname(__DIR__));
define('APP',  ROOT_FOLDER. '/app');
define('CONFIG', ROOT_FOLDER . '/config');


$url = $_SERVER['REQUEST_URI'];

//autoload
require_once __DIR__ . "/../vendor/autoload.php";


//route
$routes = require_once CONFIG . '/routes.php';
if ($routes){
    foreach ($routes as $regexp => $route){
        Route::setRouters($regexp, $route);
    }
}
Route::dispache($url);


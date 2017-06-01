<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use core\Route;

define('APP', dirname(__DIR__) . '/app');
define('ROOT_FOLDER', __DIR__.'/..');

$url = $_SERVER['REQUEST_URI'];

//autoload
require_once __DIR__ . "/../vendor/autoload.php";


//route
$routes = require_once __DIR__ . '/../config/routes.php';
if ($routes){
    foreach ($routes as $regexp => $route){
        Route::setRouters($regexp, $route);
    }
}
Route::dispache($url);


<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use core\Route;
use Illuminate\Database\Capsule\Manager as Capsule;

define('ROOT_FOLDER', dirname(__DIR__));
define('APP',  ROOT_FOLDER. '/app');
define('CONFIG', ROOT_FOLDER . '/config');


$url = $_SERVER['REQUEST_URI'];

//autoload
require_once __DIR__ . "/../vendor/autoload.php";


//DB
$capsule = new Capsule();
$dbConfig = require_once CONFIG .'/db.php';
$capsule->addConnection([
    'driver'    => $dbConfig['driver'],
    'host'      => $dbConfig['host'],
    'database'  => $dbConfig['database'],
    'username'  => $dbConfig['username'],
    'password'  => $dbConfig['password'],
    'charset'   => $dbConfig['charset'],
    'collation' => $dbConfig['collation'],
    'prefix'    => $dbConfig['prefix']
]);
$capsule->bootEloquent();



//route
$routes = require_once CONFIG . '/routes.php';
if ($routes){
    foreach ($routes as $regexp => $route){
        Route::setRouters($regexp, $route);
    }
}
Route::dispache($url);


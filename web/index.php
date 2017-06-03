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
    'driver'    => $dbConfig['environments'][$dbConfig['environments']['default_database']]['adapter'],
    'host'      => $dbConfig['environments'][$dbConfig['environments']['default_database']]['host'],
    'database'  => $dbConfig['environments'][$dbConfig['environments']['default_database']]['name'],
    'username'  => $dbConfig['environments'][$dbConfig['environments']['default_database']]['user'],
    'password'  => $dbConfig['environments'][$dbConfig['environments']['default_database']]['pass'],
    'charset'   => $dbConfig['environments'][$dbConfig['environments']['default_database']]['charset'],
    'collation' => $dbConfig['environments'][$dbConfig['environments']['default_database']]['collation'],
    'prefix'    => $dbConfig['environments'][$dbConfig['environments']['default_database']]['prefix']
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


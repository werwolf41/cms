<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use vendor\core\Route;
use Illuminate\Database\Capsule\Manager as Capsule;
use vendor\core\Registry;

define('ROOT_FOLDER', dirname(__DIR__));
define('APP',  ROOT_FOLDER. '/app');
define('CONFIG', ROOT_FOLDER . '/config');


$url = rtrim($_SERVER['REQUEST_URI'], '/');

//autoload
require_once __DIR__ . "/../vendor/autoload.php";

spl_autoload_register(function ($class)
    {
        $file = ROOT_FOLDER .'/'.str_replace('\\', '/', $class).'.php';
        if (file_exists($file)) {
            require_once $file;
        }
    });


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

//Registry
$app = Registry::instance();


//Route
$routes = require_once CONFIG . '/routes.php';
if ($routes){
    foreach ($routes as $regexp => $route){
        Route::setRouters($regexp, $route);
    }
}
Route::dispache($url);


<?php
use Nextras\Migrations\Bridges;
use Nextras\Migrations\Controllers;
use Nextras\Migrations\Drivers;
use Nextras\Migrations\Extensions;

require __DIR__ . '/../vendor/autoload.php';
define('ROOT_FOLDER', dirname(__DIR__));
define('CONFIG', ROOT_FOLDER . '/config');

$dbConfig = require_once CONFIG .'/db.php';

$conn = new Nextras\Dbal\Connection([
    'driver'    => $dbConfig['driver'],
    'host'      => $dbConfig['host'],
    'database'  => $dbConfig['database'],
    'username'  => $dbConfig['username'],
    'password'  => $dbConfig['password'],
    'charset'   => $dbConfig['charset'],
    'collation' => $dbConfig['collation'],
    'prefix'    => $dbConfig['prefix']
]);



$dbal = new Bridges\NextrasDbal\NextrasAdapter($conn);


$driver = new Drivers\MySqlDriver($dbal);

$controller = new Controllers\HttpController($driver);
// or         new Controllers\ConsoleController($driver);

$baseDir = __DIR__;
$controller->addGroup('structures', "$baseDir/structures");
$controller->addGroup('basic-data', "$baseDir/basic-data", ['structures']);
$controller->addGroup('dummy-data', "$baseDir/dummy-data", ['basic-data']);
$controller->addExtension('sql', new Extensions\SqlHandler($driver));

$controller->run();
<?php
use app\engine\Registry;
use app\engine\Route;

require_once __DIR__."/../../vendor/autoload.php";

//Registry
$registry = new Registry();

new Route();
var_dump($_SERVER);
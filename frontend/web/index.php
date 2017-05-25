<?php
use app\engine\Registry;

require_once __DIR__."/../../vendor/autoload.php";

//Registry
$registry = new Registry();
$registry->setRegistry('test', 'test');

echo $registry->getRegistry('test');
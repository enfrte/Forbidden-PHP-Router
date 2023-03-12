<?php

//use FW\Autoloader;
//use FW\Router;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/FW/Autoloader.php';

Autoloader::register(__DIR__, ['FW', 'Classes', 'Controllers', 'Models']);

$router = new Router();
$router->setBasePath('/Forbidden-PHP-Router');

// Routes

$router->add('GET', '/test/{id}', 'TestController', 'test');

$response = $router->match($_SERVER);
echo $response;

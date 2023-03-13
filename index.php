<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/Autoloader.php';

$router = new FW\Router();
$router->setBasePath('/Forbidden-PHP-Router');

// Routes - (REQUEST type, URL, Path to class, Method)

$router->add('GET', '/', Controllers\TestController::class, 'index');
$router->add('GET', '/test/{id}', Controllers\TestController::class, 'test');

$response = $router->match($_SERVER);
echo $response;

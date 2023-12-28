<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Kernel\Request;
use App\Kernel\Router;

$request = new Request();
$router = new Router();

$router->register('routes.php');
$router->resolve($request);
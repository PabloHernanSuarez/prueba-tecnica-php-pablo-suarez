<?php

use App\Kernel\Router;

Router::post('/user/new', [\App\Http\Controllers\UserController::class, 'userNew']);
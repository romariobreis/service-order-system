<?php

use App\Controllers\ServiceController;
use App\Middlewares\AuthMiddleware;

$router->get('/register-new-service', ServiceController::class, 'registerForm', [AuthMiddleware::class]);
$router->post('/service/create', ServiceController::class, 'create', [AuthMiddleware::class]);

return $router;

<?php

use App\Controllers\ServiceController;
use App\Middlewares\AuthMiddleware;

$router->get('/register-new-service', ServiceController::class, 'registerForm', [AuthMiddleware::class]);
$router->post('/service/create', ServiceController::class, 'create', [AuthMiddleware::class]);
$router->post('/service/finish', ServiceController::class, 'finish', [AuthMiddleware::class]);
$router->get('/service/{id}/edit', ServiceController::class, 'edit', [AuthMiddleware::class]);
$router->post('/service/{id}/update', ServiceController::class, 'update', [AuthMiddleware::class]);

return $router;

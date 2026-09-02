<?php

use App\Controllers\AuthController;
use App\Middlewares\AuthMiddleware;

$router->get('/', AuthController::class, 'index');
$router->post('/login', AuthController::class, 'login');
$router->get('/logout', AuthController::class, 'logout', [AuthMiddleware::class]);

return $router;

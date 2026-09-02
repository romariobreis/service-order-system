<?php

use App\Controllers\DashboardController;
use App\Middlewares\AuthMiddleware;

$router->get('/dashboard', DashboardController::class, 'index', [AuthMiddleware::class]);

return $router;

<?php

use App\Controllers\AuthController;

$router->get('/', AuthController::class, 'index');
$router->post('/login', AuthController::class, 'login');
$router->get('/logout', AuthController::class, 'logout');

return $router;

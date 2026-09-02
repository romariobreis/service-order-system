<?php

use App\Controllers\UserController;

$router->get('/register-new-user', UserController::class, 'registerForm');
$router->post('/register', UserController::class, 'register');

return $router;

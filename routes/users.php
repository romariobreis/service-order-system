<?php

use App\Controllers\UserController;

$router->get('/register-new-user', UserController::class, 'registerForm');

return $router;

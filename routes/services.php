<?php

use App\Controllers\ServiceController;

$router->get('/register-new-service', ServiceController::class, 'registerForm');

return $router;

<?php

use App\Controllers\AuthController;

$router->get('/', AuthController::class, 'index');

return $router;

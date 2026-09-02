<?php

use Core\Router;

require_once __DIR__ . '/config/configuration.php';

$router = new Router();

require_once __DIR__ . '/routes/auth.php';
require_once __DIR__ . '/routes/users.php';
require_once __DIR__ . '/routes/services.php';

$router->dispatch();

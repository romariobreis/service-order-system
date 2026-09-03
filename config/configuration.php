<?php

use Core\Environment;

session_start();

require_once dirname(__DIR__) . '/core/autoload.php';

Environment::load(dirname(__DIR__));

require_once __DIR__ . '/constants.php';

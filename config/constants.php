<?php

if (!defined('BASE_URL')) {
  $basePath = dirname($_SERVER['SCRIPT_NAME']);
  define('BASE_URL', rtrim($basePath, '/') . '/');
}

if (!defined('BASE_PUBLIC')) {
  define('BASE_PUBLIC', BASE_URL . 'public/');
}

if (!defined('BASE_VIEWS')) {
  define('BASE_VIEWS', BASE_URL . 'app/Views/');
}

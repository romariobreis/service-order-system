<?php

spl_autoload_register(function ($class) {
  $baseDir = dirname(__DIR__) . '/';

  $namespaces = [
    'Core\\' => 'core/',
    'App\\'  => 'src/'
  ];

  foreach ($namespaces as $prefix => $dir) {
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) === 0) {
      $relativeClass = substr($class, $len);

      $file = $baseDir . $dir . str_replace('\\', '/', $relativeClass) . '.php';

      if (file_exists($file)) {
        require $file;
        return;
      }
    }
  }
});

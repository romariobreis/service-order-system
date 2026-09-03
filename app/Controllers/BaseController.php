<?php

namespace App\Controllers;

abstract class BaseController
{
  protected function view(string $path, array $data = []): void
  {
    extract($data);

    $file = __DIR__ . '/../Views/' . $path . '.php';

    if (file_exists($file)) {
      require_once $file;
    } else {
      throw new \Exception("Página '{$path}' não encontrada.");
    }
  }
}

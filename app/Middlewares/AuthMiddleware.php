<?php

namespace App\Middlewares;

class AuthMiddleware
{
  public function handle(): bool
  {
    if (!empty($_SESSION['user_id'])) {
      return true;
    }

    $_SESSION = [];

    if (session_status() === PHP_SESSION_ACTIVE) {
      session_destroy();
    }

    if (isset($_COOKIE['jm_user'])) {
      setcookie('jm_user', '', time() - 86400, '/');
    }

    header('Location: ' . BASE_URL);
    exit;
  }
}

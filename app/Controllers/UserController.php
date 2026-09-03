<?php

namespace App\Controllers;

use App\Services\UserService;

class UserController extends BaseController
{
  private UserService $userService;

  public function __construct()
  {
    $this->userService = new UserService();
  }

  public function registerForm(): void
  {
    $this->view('register-new-user');
  }

  public function register(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'] ?? 'Usuário';
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      if ($this->userService->registerUser($name, $email, $password)) {
        header('Location: ' . BASE_URL);
        exit;
      } else {
        header('Location: ' . BASE_URL . 'register-new-user');
        exit;
      }
    }
  }
}

<?php

namespace App\Controllers;

use App\Services\UserService;

class UserController extends BaseController
{
  private $userService;

  public function __construct()
  {
    $this->userService = new UserService();
  }

  public function registerForm()
  {
    $this->view('register-new-user');
  }

  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      if ($this->userService->registerUser($email, $password)) {
        header('Location: ' . BASE_URL);
        exit;
      } else {
        header('Location: ' . BASE_URL . 'register-new-user');
        exit;
      }
    }
  }
}

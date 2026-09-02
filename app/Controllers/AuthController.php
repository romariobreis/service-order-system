<?php

namespace App\Controllers;

use App\Services\AuthService;

class AuthController extends BaseController
{
  private $authService;

  public function __construct()
  {
    $this->authService = new AuthService();
  }

  public function index()
  {
    if (!empty($_SESSION['user_name'])) {
      header('Location: ' . BASE_URL . 'dashboard');
      exit;
    } else {
      $error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : null;
      unset($_SESSION['login_error']);

      $this->view('login', ['error' => $error]);
    }
  }

  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      if ($this->authService->authenticate($email, $password)) {
        header('Location: ' . BASE_URL);
        exit;
      } else {
        $_SESSION['login_error'] = 'Ops, Email ou Senha inválido.';
        header('Location: ' . BASE_URL);
        exit;
      }
    }
  }

  public function logout()
  {
    $this->authService->logout();

    header('Location: ' . BASE_URL);
    exit;
  }
}

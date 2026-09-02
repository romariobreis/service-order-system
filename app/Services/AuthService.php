<?php

namespace App\Services;

use App\Repositories\UserRepository;

class AuthService
{
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }

  public function authenticate($email, $password)
  {
    $user = $this->userRepository->findByEmail($email);

    if (!$user) {
      return false;
    }

    if (password_verify($password, $user['password'])) {

      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['name'];
      $_SESSION['user_email'] = $user['email'];

      setcookie('jm_user_name', $user['name'], time() + (86400), "/");

      return true;
    }

    return false;
  }

  public function logout()
  {
    session_destroy();
    setcookie('jm_user_name', '', time() - 3600, "/");
  }
}

<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }

  public function registerUser(string $email, string $password): bool
  {
    if (empty($email) || empty($password)) {
      return false;
    }

    $existingUser = $this->userRepository->findByEmail($email);
    if ($existingUser) {
      return false;
    }

    return $this->userRepository->create($email, $password);
  }
}

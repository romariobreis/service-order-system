<?php

namespace App\Repositories;

use App\Models\UserModel;
use Core\Database\Connection;
use PDO;

class UserRepository
{
  private Connection $db;

  public function __construct()
  {
    $this->db = Connection::getInstance();
  }

  public function findById(int $id): ?UserModel
  {
    $sql = "SELECT * FROM user WHERE id_user = :id LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
    $stmt->execute([':id' => $id]);
    $result = $stmt->fetch();
    $result = !empty($result) ? $result : null;

    return $result;
  }

  public function findByEmail(string $email): ?UserModel
  {
    $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
    $stmt->execute([':email' => $email]);
    $result = $stmt->fetch();
    $result = !empty($result) ? $result : null;

    return $result;
  }

  public function create(string $name, string $email, string $password): bool
  {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
      ':name' => $name,
      ':email' => $email,
      ':password' => $passwordHash
    ]);
  }
}

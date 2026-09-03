<?php

namespace App\Repositories;

use App\Models\UserModel;
use Core\Database\Connection;
use PDO;

class UserRepository
{
  private $db;

  public function __construct()
  {
    $this->db = Connection::getInstance();
  }

  public function findAll()
  {
    $sql = "SELECT * FROM user";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function findById(int $id)
  {
    $sql = "SELECT * FROM user WHERE id_user = :id LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
  }

  public function findByEmail(string $email)
  {
    $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create(string $name, string $email, string $password)
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

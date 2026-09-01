<?php

namespace App\Repositories;

use App\Models\UserModel;
use Core\Database\Connection;

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
}

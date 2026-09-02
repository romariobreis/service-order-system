<?php

namespace App\Repositories;

use App\Models\ServiceModel;
use Core\Database\Connection;

class ServiceRepository
{
  private $db;

  public function __construct()
  {
    $this->db = Connection::getInstance();
  }

  public function findAll()
  {
    $sql = "SELECT * FROM service";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function findAllWithUser()
  {
    $sql = "SELECT s.id_service, s.description, s.price, s.finished_at, u.name as user_name
            FROM service s
            INNER JOIN user u ON s.user_id_user = u.id_user
            ORDER BY s.id_service DESC";

    $stmt = $this->db->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  public function create(string $description, float $price, int $userId): bool
  {
    $sql = "INSERT INTO service (description, price, user_id_user) VALUES (:description, :price, :userId)";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
      ':description' => $description,
      ':price'       => $price,
      ':userId'      => $userId
    ]);
  }
}

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

  public function getTotalValueByUserId(int $userId): float
  {
    $sql = "SELECT SUM(price) as total FROM service 
            WHERE user_id_user = :userId AND finished_at IS NOT NULL";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':userId', $userId);
    $stmt->execute();
    $result = $stmt->fetch();

    return $result->total ? (float) $result->total : 0.0;
  }

  public function getLatestCompletedServices(int $userId, int $limit = 3): array
  {
    $sql = "SELECT id_service, description FROM service 
            WHERE finished_at IS NOT NULL AND user_id_user = :userId
            ORDER BY finished_at DESC 
            LIMIT :limit";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':limit', $limit);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  public function getLatestPendingServices(int $userId, int $limit = 3): array
  {
    $sql = "SELECT id_service, description FROM service 
            WHERE finished_at IS NULL AND user_id_user = :userId
            ORDER BY id_service DESC 
            LIMIT :limit";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':limit', $limit);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  public function findById(int $id)
  {
    $sql = "SELECT * FROM service WHERE id_service = :id LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
  }

  public function finishService(int $id, float $commission): bool
  {
    $sql = "UPDATE service SET finished_at = NOW(), commission_user = :commission WHERE id_service = :id";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([':commission' => $commission, ':id' => $id]);
  }

  public function findFiltered(array $filters)
  {
    $sql = "SELECT s.id_service, s.description, s.price, s.created_at, s.finished_at, u.name as user_name FROM service s
            INNER JOIN user u ON s.user_id_user = u.id_user
            WHERE 1=1";

    $params = [];

    if (!empty($filters['serviceName'])) {
      $sql .= " AND s.description LIKE :serviceName";
      $params[':serviceName'] = '%' . $filters['serviceName'] . '%';
    }

    if (!empty($filters['userName'])) {
      $sql .= " AND u.name LIKE :userName";
      $params[':userName'] = '%' . $filters['userName'] . '%';
    }

    if (!empty($filters['status'])) {
      if ($filters['status'] === 'pending') {
        $sql .= " AND s.finished_at IS NULL";
      } elseif ($filters['status'] === 'finished') {
        $sql .= " AND s.finished_at IS NOT NULL";
      }
    }

    if (!empty($filters['startDate'])) {
      $sql .= " AND DATE(s.created_at) >= :startDate";
      $params[':startDate'] = $filters['startDate'];
    }

    if (!empty($filters['endDate'])) {
      $sql .= " AND DATE(s.created_at) <= :endDate";
      $params[':endDate'] = $filters['endDate'];
    }

    $sql .= " ORDER BY s.id_service DESC";

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll();
  }

  public function update(int $id, string $description, float $price): bool
  {
    $sql = "UPDATE service 
            SET description = :description, price = :price, update_at = NOW() 
            WHERE id_service = :id";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
      ':description' => $description,
      ':price'       => $price,
      ':id'          => $id
    ]);
  }
}

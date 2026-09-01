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
}

<?php

namespace Core\Database;

use PDO;
use PDOException;

class Connection
{
  private static ?Connection $instance = null;
  private ?PDO $connection = null;

  private const CHARSET = 'utf8mb4';
  private const OPTIONS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_CASE => PDO::CASE_NATURAL,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];

  final private function __construct()
  {
    $this->connect();
  }

  public static function getInstance(): Connection
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function connect(): void
  {
    if (empty(self::$instance)) {
      try {
        $host   = $_ENV['DB_HOST'] ?? 'localhost';
        $dbName = $_ENV['DB_NAME'] ?? 'service_order_system';
        $user   = $_ENV['DB_USER'] ?? 'root';
        $pass   = $_ENV['DB_PASS'] ?? '';

        $this->connection = new PDO(
          "mysql:host={$host};dbname={$dbName};charset=" . self::CHARSET,
          $user,
          $pass,
          self::OPTIONS
        );
      } catch (PDOException $e) {
        throw new \Exception('Database connection error: ' . $e->getMessage());
      }
    }
  }

  public function prepare(String $sql): \PDOStatement
  {
    return $this->connection->prepare($sql);
  }
}

<?php

namespace Core\Database;

use PDO;
use PDOException;

class Connection
{
  private static ?Connection $instance = null;
  private ?PDO $connection = null;

  private const HOST = 'localhost';
  private const DB_NAME = 'service_order_system';
  private const USER = 'admin';
  private const PASSWD = 'jY6u7&Ugc7*';
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

  public static function getInstance()
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
        $this->connection = new PDO(
          'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME . ';charset=' . self::CHARSET,
          self::USER,
          self::PASSWD,
          self::OPTIONS
        );
      } catch (PDOException $e) {
        throw new \Exception('Database connection error: ' . $e->getMessage());
      }
    }
  }

  public function prepare(String $sql)
  {
    return $this->connection->prepare($sql);
  }
}

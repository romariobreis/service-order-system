<?php

namespace Core\Database;

use PDO;
use PDOException;

class Connection
{
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
  private static $instance;

  final private function __construct() {}

  public static function getInstance(): PDO
  {
    if (empty(self::$instance)) {
      try {
        self::$instance = new PDO(
          'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME . ';charset=' . self::CHARSET,
          self::USER,
          self::PASSWD,
          self::OPTIONS
        );
      } catch (PDOException $e) {
        throw new \Exception('Database connection error: ' . $e->getMessage());
      }
    }

    return self::$instance;
  }
}

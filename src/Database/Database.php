<?php

namespace AnotherDay\Database;

use AnotherDay\Database\DatabaseConfig;
use Exception;
use PDO;

class Database
{
  private string $stringConnection;
  private DatabaseConfig $databaseConfig;
  private static PDO $pdo;

  public function __construct(DatabaseConfig $databaseConfig)
  {
    $this->databaseConfig = $databaseConfig;
    $this->stringConnection($databaseConfig);

    $this->connection();
  }

  private function stringConnection(DatabaseConfig $config): void
  {
    $nameHost = $config->dsn() . ':dbname=' . $config->host();
    $patch    = $config->path() . $config->dbname() . '.fdb;charset=' . $config->charset() . ';dialect=3';

    $this->stringConnection = $nameHost . ':' . $patch;
  }

  private function connection()
  {
    try {

      $pdo = new PDO(
        $this->stringConnection,
        $this->databaseConfig->user(),
        $this->databaseConfig->password()
      );

      $this->setAttributes($pdo);

      self::$pdo = $pdo;
    } catch (Exception $err) {
      echo '<pre>';
      print_r($err->getMessage());
      echo '</pre>';
      exit;
    }
  }

  public function executeQuery(string $query, array $params = [])
  {
    try {
      $query = self::$pdo->prepare($query);
      $query->execute($params);

      $results = $query->fetchAll(PDO::FETCH_ASSOC);

      return $results;
    } catch (Exception $err) {
      echo '<pre>';
      print_r($err->getMessage());
      echo '</pre>';
      exit;
    }
  }

  public function getPdo(): PDO
  {
    return self::$pdo;
  }

  private function setAttributes(PDO &$pdo): void
  {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
    $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
  }
}

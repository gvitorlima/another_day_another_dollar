<?php

namespace AnotherDay\Database;

use AnotherDay\Database\DatabaseConfig;
use Exception;
use PDO;

class Database
{
  private string $stringConnection;
  private DatabaseConfig $databaseConfig;

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

    } catch (Exception $err) {
      echo '<pre>';
      print_r($err->getMessage());
      echo '</pre>';
      exit;
    }
  }
}

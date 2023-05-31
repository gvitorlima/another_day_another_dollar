<?php

namespace AnotherDay\Database;

use AnotherDay\Database\DatabaseConfig;

class Database
{
  private string $stringConnection;

  public function __construct(DatabaseConfig $database)
  {
    $this->stringConnection($database);
  }

  private function stringConnection(DatabaseConfig $database): void
  {
    $nameHost = $database->dsn() . $database->dbname() . $database->host();
    $patch    = $database->path() . $database->dbname() . '.fdb;' . $database->charset() . ';dialect=1';

    $this->stringConnection = $nameHost . ':' . $patch;
  }
}

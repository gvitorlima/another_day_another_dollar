<?php

namespace AnotherDay\Database;

use AnotherDay\Database\Database;
use AnotherDay\Database\DatabaseConfig;

class DatabaseManager extends DatabaseConfig
{
  private static DatabaseConfig $config;
  private static Database $database;

  public static function getInstance(array $configConnection)
  {
    if (!isset(self::$database))
      return [];

    return self::$database;
  }

  public static function createConnection(array $configConnection)
  {
    self::$config   = new DatabaseConfig($configConnection);
    self::$database = new Database(self::$config);
  }

  public static function executeQuery(string $query)
  {
    return self::$database->executeQuery($query);
  }
}

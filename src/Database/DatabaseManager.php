<?php

use AnotherDay\Database\Database;
use AnotherDay\Database\DatabaseConfig;

class DatabaseManager extends DatabaseConfig
{
  private static DatabaseConfig $config;
  private static Database $database;

  public static function getInstance(array $configConnection)
  {
    if (isset(self::$database))
      return self::$database;
  }

  public static function createConnection(array $configConnection)
  {
    self::$config   = new DatabaseConfig($configConnection);
    self::$database = new Database(self::$config);
  }
}

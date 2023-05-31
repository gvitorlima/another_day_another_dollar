<?php

namespace AnotherDay\Database;

class DatabaseConfig
{
  private string
    $dsn,
    $dbname,
    $charset,
    $host,
    $path;

  protected function __construct(array $configConnection)
  {
    $this->dsn = $configConnection['dsn'];
    $this->dbname = $configConnection['dbname'];
    $this->charset = $configConnection['charset'];
    $this->host = $configConnection['host'];
    $this->path = $configConnection['path'];
  }

  public function stringConnection(): string
  {
    return $this->dsn . ':' .
      $this->dbname . '=' .
      $this->host . $this->path .
      $this->dbname . '.fdb;' .
      $this->charset . ';dialect=3';
  }

  public function dsn(): string
  {
    return $this->dsn;
  }

  public function dbname(): string
  {
    return $this->dbname;
  }

  public function charset(): string
  {
    return $this->charset;
  }

  public function host(): string
  {
    return $this->host;
  }

  public function path(): string
  {
    return $this->path;
  }
}

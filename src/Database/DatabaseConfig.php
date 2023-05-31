<?php

namespace AnotherDay\Database;

class DatabaseConfig
{
  private string
    $user,
    $password,
    $dsn,
    $dbname,
    $charset,
    $host,
    $path;

  protected function __construct(array $configConnection)
  {
    $this->user = $configConnection['user'];
    $this->password = $configConnection['pass'];
    $this->dsn = $configConnection['dsn'];
    $this->dbname = $configConnection['dbname'];
    $this->charset = $configConnection['charset'];
    $this->host = $configConnection['host'];
    $this->path = $configConnection['path'];
  }

  public function password(): string
  {
    return $this->password;
  }

  public function user(): string
  {
    return $this->user;
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

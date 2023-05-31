<?php

function database(): array
{
  if (getenv('PRODUCTION') == 1) {
    return [
      'dsn' => getenv('DSN'),
      'dbname' => getenv('DBNAME'),
      'charset' => getenv('CHARSET'),
      'host' => getenv('HOST'),
      'path' => getenv('PATH'),
      'user' => getenv('USER'),
      'pass' => getenv('PASS')
    ];
  }

  return [
    'dsn' => getenv('DEV-DSN'),
    'dbname' => getenv('DEV-DBNAME'),
    'charset' => getenv('DEV-CHARSET'),
    'host' => getenv('DEV-HOST'),
    'path' => getenv('DEV-PATH'),
    'user' => getenv('DEV-USER'),
    'pass' => getenv('DEV-PASS')
  ];
}

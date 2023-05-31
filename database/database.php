<?php

function database(): array
{
  if (getenv('PRODUCTION')) {
    return [
      'dsn' => getenv('DSN'),
      'dbname' => getenv('DBNAME'),
      'charset' => getenv('CHARSET'),
      'host' => getenv('HOST'),
      'path' => getenv('PATH')
    ];
  }

  return [
    'dsn' => getenv('DEV-DSN'),
    'dbname' => getenv('DEV-DBNAME'),
    'charset' => getenv('DEV-CHARSET'),
    'host' => getenv('DEV-HOST'),
    'path' => getenv('DEV-PATH')
  ];
}

<?php

$envPatch = __DIR__ . '/../.env';
$env = file($envPatch, 1);

foreach ($env as $key => $data) {
  if (str_starts_with($data, '#')) {
    continue;
  }

  putenv($data);
}

<?php

$envPatch = __DIR__ . '/../.env';
$env = file($envPatch, FILE_SKIP_EMPTY_LINES);

foreach ($env as $key => $data) {
  $data = trim($data);

  if (str_starts_with($data, '#') || empty($data)) {
    continue;
  }

  putenv($data);
}

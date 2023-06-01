<?php

use AnotherDay\Database\DatabaseManager;

require_once __DIR__ . '/../database/database.php';

$dataConnection = database();
DatabaseManager::createConnection($dataConnection);

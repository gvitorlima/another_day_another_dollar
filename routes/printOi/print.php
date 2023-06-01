<?php

use AnotherDay\Database\DatabaseManager;
use AnotherDay\Http\Request;
use AnotherDay\Http\Response;
use AnotherDay\Http\Router;

Router::get('/', [
  function (Request $request, Response $response) {
    return DatabaseManager::executeQuery('SELECT * FROM LOGIN');
  }
]);

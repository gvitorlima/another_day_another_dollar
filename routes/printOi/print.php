<?php

use AnotherDay\Http\Request;
use AnotherDay\Http\Response;
use AnotherDay\Http\Router;

Router::get('/print', [
  function (Request $request, Response $response) {
    return [
      'response' => 'Oi'
    ];
  }
]);

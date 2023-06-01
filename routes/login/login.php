<?php

use AnotherDay\Controller\Login\LoginController;
use AnotherDay\Http\Request;
use AnotherDay\Http\Response;
use AnotherDay\Http\Router;

Router::post('/login', [
  function (Request $request, Response $response) {

    $controller = new LoginController;
    return $controller->login($request, $response);
  }
]);

Router::post('/create/login', [
  function (Request $request, Response $response) {

    $controller = new LoginController;
    return $controller->create($request, $response);
  }
]);

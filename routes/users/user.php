<?php

use AnotherDay\Controller\User\UserController;
use AnotherDay\Http\Request;
use AnotherDay\Http\Response;
use AnotherDay\Http\Router;

Router::post('/user', [
  function (Request $request, Response $response) {

    $controller = new UserController;
    return $controller->getUser($request, $response);
  }
]);

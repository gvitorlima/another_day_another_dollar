<?php

use AnotherDay\Http\Router;

$routesPatch = __DIR__ . '/../routes';

$router = Router::init($routesPatch);
$router->run()
  ->sendResponse();

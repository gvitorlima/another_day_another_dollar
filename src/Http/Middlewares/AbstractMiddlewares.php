<?php

namespace AnotherDay\Http\Middlewares;

use AnotherDay\Http\Request;

abstract class AbstractMiddlewares
{
  final public function __invoke(Request $request, \Closure $controller)
  {
    return $this->handle($request, $controller);
  }

  abstract public function handle(Request $request, \Closure $controller);
}

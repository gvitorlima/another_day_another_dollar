<?php

namespace AnotherDay\Http\Middlewares;

use AnotherDay\Http\Request;

class Queue
{
  public function __construct(private array $middlewares, private array $vars, private \Closure $controller)
  {
  }

  public function nextMiddleware(Request $request): Mixed
  {
    if (empty($this->middlewares))
      return call_user_func_array($this->controller, $this->vars ?? []);

    $key = array_key_first($this->middlewares);
    $middleware = $this->middlewares[$key];

    if (!class_exists($middleware))
      throw new \Exception("Middleware inexistente: ${key}", 500);

    $queue = $this;
    $nextFunction = function () use ($request, $queue) {
      return $queue->nextMiddleware($request);
    };

    return (new $middleware)->handle($request, $nextFunction);
  }
}

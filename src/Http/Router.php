<?php

declare(strict_types=1);

namespace AnotherDay\Http;

use AnotherDay\Http\Middlewares\Queue;
use AnotherDay\Http\Request;
use AnotherDay\Http\Response;

class Router
{
  const MIDDLEWARES = 'MIDDLEWARES';

  private static self $instance;
  private Request $request;
  private Response $response;

  // Array que armazena todas a rotas do projeto.
  private static array $routes;

  private function __construct()
  {
    $this->request = Request::create();
    $this->response = Response::create();
  }

  /**
   * Recebe o caminho base para os arquivos onde ficam as roras seguindo o esquema de árvores
   * Pasta raiz --- Pasta rota x --- Arquivo de rota.php
   */
  public static function init(string $pathRoutes): self
  {
    if (isset(self::$instance))
      return self::$instance;

    if (!file_exists($pathRoutes))
      throw new \Exception("Raiz do arquivo das rotas não encontrado", 500);

    self::includeRoutesArchives($pathRoutes);
    return (self::$instance = new self);
  }

  private static function includeRoutesArchives(string $pathRoutes): void
  {
    $archives = glob($pathRoutes . '/*/*.php');
    if (empty($archives) || !isset($archives))
      throw new \Exception("Verifique a arvore de arquivo das rotas", 500);

    foreach ($archives as $route) {
      include_once $route;
    }
  }

  public static function get(string $route, array $params): void
  {
    self::addRoute('GET', $route, $params);
  }

  public static function post(string $route, array $params): void
  {
    self::addRoute('POST', $route, $params);
  }

  public static function put(string $route, array $params): void
  {
    self::addRoute('PUT', $route, $params);
  }

  public static function path(string $route, array $params): void
  {
    self::addRoute('PATH', $route, $params);
  }

  public static function delete(string $route, array $params): void
  {
    self::addRoute('DELETE', $route, $params);
  }

  private static function addRoute(string $method, string $route, array $params): void
  {
    foreach ($params as $key => $param) {
      if ($param instanceof \Closure) {
        $params['controller'] = $param;
        unset($params[$key]);
      }
    }

    $route = '/^' . str_replace('/', '\/', $route) . '$/';
    $regexVars = '/{(.*?)}/';

    if (preg_match_all($regexVars, $route, $matches)) {
      $route = preg_replace($regexVars, '(.*?)', $route);
    }

    self::$routes[$route] = [
      $method => $params,
      'vars' => $matches[array_key_last($matches) ?? null]
    ];
  }

  /**
   * Executa a rota acessada.
   */
  public function run(): Response
  {
    try {
      $controller = $this->getRoute();
      if (!$controller['controller'])
        throw new \Exception("Controlador não encontrado", 500);

      $this->runRules();
      $data = $this->runMiddlewares($controller);

      return $data instanceof Response ? $data : $this->response->setResponse(200, $data);
    } catch (\Exception $err) {

      return $this->response->setResponse(
        $err->getCode(),
        [
          'code' => $err->getCode(),
          'message' => $err->getMessage()
        ]
      );
    }
  }

  private function runMiddlewares(array $dataController): mixed
  {
    return (new Queue(
      $dataController[self::MIDDLEWARES] ?? [],
      $dataController['vars'] ?? [],
      $dataController['controller']
    ))->nextMiddleware($this->request);
  }

  // ! TODO fazer os 'middlewares' de regras
  private function runRules(): void
  {
  }

  private function getRoute(): array
  {
    $uri = $this->request->getUri();
    $httpMethod = $this->request->getHttpMethod();

    foreach (self::$routes as $route => $method) {
      if (preg_match($route, $uri, $matches)) {

        if ($method[$httpMethod]) {
          unset($matches[0]);

          $method[$httpMethod]['vars'] = array_combine($method['vars'], $matches);

          $method[$httpMethod]['vars']['request']  = $this->request;
          $method[$httpMethod]['vars']['response'] = $this->response;

          return $method[$httpMethod];
        }

        throw new \Exception("Método não permitido", 405);
      }
    }

    throw new \Exception("Rota não encontrada", 404);
  }
}

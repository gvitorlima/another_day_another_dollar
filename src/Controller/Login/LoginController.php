<?php

namespace AnotherDay\Controller\Login;

use AnotherDay\Http\Request;
use AnotherDay\Http\Response;
use AnotherDay\Service\Login\LoginService;
use Exception;

class LoginController
{
  private LoginService $service;
  public function __construct()
  {
    $this->service = new LoginService;
  }

  public function login(Request $request, Response $response)
  {
    $request->getPostVars();
  }

  public function create(Request $request, Response $response)
  {
    $postVars = (object)$request->getPostVars();

    $user = $postVars->user ?? [];
    $account = $postVars->data_account ?? [];

    try {
      $newUser = $this->service->create($user, $account);

      return $response
        ->setResponse(200, $newUser);
    } catch (Exception $err) {
      echo '<pre>';
      print_r($err->getMessage());
      echo '</pre>';
      exit;
    }
  }
}

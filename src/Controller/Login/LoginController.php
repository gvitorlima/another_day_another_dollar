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
    $postVars = $request->getPostVars();

    try {

      
    } catch (Exception $err) {
    }
  }
}

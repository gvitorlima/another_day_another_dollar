<?php

namespace AnotherDay\Controller\User;

use AnotherDay\Http\Request;
use AnotherDay\Http\Response;
use AnotherDay\Service\User\UserService;
use Exception;

class UserController
{
  private UserService $service;
  public function __construct()
  {
    $this->service = new UserService;
  }

  public function getUser(Request $request, Response $response)
  {
    $postVars = $request->getPostVars();
    echo '<pre>';
    print_r($postVars);
    echo '</pre>';
    exit;
    try {
    } catch (Exception $err) {
      echo '<pre>';
      print_r($err->getMessage());
      echo '</pre>';
      exit;
    }
  }
}

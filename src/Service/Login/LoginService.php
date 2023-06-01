<?php

namespace AnotherDay\Service\Login;

use AnotherDay\Repositories\LoginRepository;
use Exception;

class LoginService
{
  private LoginRepository $repository;
  public function __construct()
  {
    $this->repository = new LoginRepository;
  }

  public function login(string $email, string $password)
  {
  }

  public function create()
  {
    try {
    } catch (Exception $err) {
    }
  }
}

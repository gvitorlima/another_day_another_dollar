<?php

namespace AnotherDay\Service\User;

use AnotherDay\Repositories\User\UserRepository;
use Exception;

class UserService
{
  private UserRepository $repository;
  public function __construct()
  {
    $this->repository = new UserRepository;
  }

  public function getUserById()
  {
    try {
    } catch (Exception $err) {
      echo '<pre>';
      print_r($err->getMessage());
      echo '</pre>';
      exit;
    }
  }

  public function getUserByUuid()
  {
  }
}

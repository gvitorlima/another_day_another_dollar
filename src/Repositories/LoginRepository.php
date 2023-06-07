<?php

namespace AnotherDay\Repositories;

use AnotherDay\Model\Login\LoginModel;

class LoginRepository
{
  public function login()
  {
  }

  public function create(array $dataCreate): array|LoginModel
  {
    
    return $this->map($dataCreate);
  }

  private function map(array $login)
  {
    return (new LoginModel($login));
  }
}

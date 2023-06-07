<?php

namespace AnotherDay\Repositories\User;

use AnotherDay\Model\User\UserModel;

class UserRepository
{
  public function byId(int $id): array|UserModel
  {
  }

  public function nameLasName(string $name, string $lastName): array|UserModel
  {
  }

  public function uuid(string $uuid): array|UserModel
  {
  }

  // private function map(): UserModel
  // {
  // }
}

<?php

namespace AnotherDay\Service\Login;

use AnotherDay\Repositories\LoginRepository;
use DateTimeImmutable;
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

  public function create(array $user, array $account)
  {
    try {

      if ($this->validateNewUser($user, $account) == false)
        throw new Exception("Dados inválidos", 400);

      $user    = $this->handleFormatUserData($user);
      $account = $this->handleFormatAccountData($account);

      echo '<pre>';
      print_r($user);
      echo '</pre>';
      exit;
    } catch (Exception $err) {
      echo '<pre>';
      print_r($err->getMessage());
      echo '</pre>';
      exit;
    }
  }

  private function handleFormatUserData(array $user)
  {
    if (!preg_match('/(\d{4}[-\/]\d{2}[-\/]\d{2})/', $user['birth_date']))
      throw new Exception("Data inválida", 400);

    $date = new DateTimeImmutable($user['birth_date']);
    if ($date->diff(new DateTimeImmutable)->y > 118)
      throw new Exception("Idade não pode ser maior que 118", 400);

    return [
      'name' => $user['name'],
      'last_name' => $user['last_name'],
      'birth_date' => $date
    ];
  }

  private function handleFormatAccountData(array $account)
  {
  }

  /**
   * !Forma de validação mais simples possível
   */
  private function validateNewUser(array $user, array $account): bool
  {
    foreach (self::usersValidateKeys() as $param) {
      if (!$user[$param])
        return false;
    }

    foreach (self::accountValidateKeys() as $param) {
      if (!$account[$param])
        return false;
    }

    return true;
  }

  private static function usersValidateKeys(): array
  {
    return [
      'name',
      'last_name',
      'birth_date'
    ];
  }

  private static function accountValidateKeys(): array
  {
    return  [
      'email',
      'password',
      'phones'
    ];
  }
}

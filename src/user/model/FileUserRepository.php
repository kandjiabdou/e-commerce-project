<?php
require_once __DIR__ . '/UserRepository.php';
require_once __DIR__ . '/UserBuilder.php';
require_once __DIR__ . '/User.php';

class FileUserRepository implements UserRepository
{
  private $FILE_NAME = __DIR__ . '/../../../data/users.json';
  private $FIRST_NAME_KEY = 'firstName';
  private $LAST_NAME_KEY = 'lastName';
  private $USERNAME_KEY = 'username';
  private $PASSWORD_KEY = 'password';

  public function __construct()
  {
    if (!file_exists($this->FILE_NAME)) {
      file_put_contents($this->FILE_NAME, $this->toJson([]));
    }
  }

  public function checkUserExistence(string $username, string $password): bool
  {
    $users = $this->getAllUsers();
    foreach ($users as $user) {
      if ($user[$this->USERNAME_KEY] === $username && $user[$this->PASSWORD_KEY] === $password) {
        return true;
      }
    }
    return false;
  }

  public function getUserByUsername(string $username): ?User
  {
    $users = $this->getAllUsers();
    foreach ($users as $user) {
      if ($user[$this->USERNAME_KEY] === $username) {
        $userBuilder = new UserBuilder();
        return $userBuilder
          ->withFirstName($user[$this->FIRST_NAME_KEY])
          ->withLastName($user[$this->LAST_NAME_KEY])
          ->withUsername($user[$this->USERNAME_KEY])
          ->build();
      }
    }
    return null;

  }

  public function createUser($firstName, $lastName, $username, $password): void
  {
    $users = $this->getAllUsers();
    $users[] = [
      $this->FIRST_NAME_KEY => $firstName,
      $this->LAST_NAME_KEY => $lastName,
      $this->USERNAME_KEY => $username,
      $this->PASSWORD_KEY => $password,
    ];
    file_put_contents($this->FILE_NAME, $this->toJson($users));
  }

  private function getAllUsers()
  {
    return $this->fromJson(file_get_contents($this->FILE_NAME));
  }

  private function toJson($value)
  {
    return json_encode($value);
  }

  private function fromJson($value)
  {
    return json_decode($value, true);
  }
}

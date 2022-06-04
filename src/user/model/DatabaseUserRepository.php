<?php
require_once __DIR__ . '/../../common/DatabaseClient.php';
require_once __DIR__ . '/UserRepository.php';
require_once __DIR__ . '/UserBuilder.php';
require_once __DIR__ . '/User.php';

class DatabaseUserRepository implements UserRepository
{
  private $database;

  public function __construct()
  {
    $this->database = DatabaseClient::getDatabase();
  }

  public function checkUserExistence(string $username, string $password): bool
  {
    $request = $this->database->prepare('SELECT count(*) AS numberOfUsers FROM user WHERE username = :username AND password = md5(:password)');
    $request->execute([
      'username' => $username,
      'password' => $password
    ]);

    return $request->fetch(PDO::FETCH_OBJ)->numberOfUsers > 0;
  }

  public function getUserByUsername(string $username): ?User
  {
    $request = $this->database->prepare('SELECT firstname, lastname, username FROM user WHERE username = :username');
    $request->execute(['username' => $username]);
    $user = $request->fetch(PDO::FETCH_OBJ);

    if (!$user) {
      return null;
    }

    $userBuilder = new UserBuilder();
    return $userBuilder
      ->withFirstName($user->firstname)
      ->withLastName($user->lastname)
      ->withUsername($user->username)
      ->build();
  }

  public function createUser($firstName, $lastName, $username, $password): void
  {
    $request = $this->database->prepare('INSERT INTO user(firstname, lastname, mode, username, password) VALUES (:firstname, :lastname, 2, :username, md5(:password))');
    $request->execute([
      'firstname' => $firstName,
      'lastname' => $lastName,
      'username' => $username,
      'password' => $password
    ]);
  }
}

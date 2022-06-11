<?php
require_once '../src/model/UserRepository.php';
require_once '../src/common/DatabaseClient.php';

class DatabaseUserRepository implements UserRepository{
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

  public function isUserNameExist(string $username):bool{
    $request = $this->database->prepare('SELECT firstname, lastname, username FROM user WHERE username = :username');
    $request->execute(['username' => $username]);
    $user = $request->fetch(PDO::FETCH_OBJ);
    return ($user !== false);
  }

  public function createUser($firstName, $lastName, $username, $password): void
  {
    $request = $this->database->prepare('INSERT INTO user(firstname, lastname, role, username, password) VALUES (:firstname, :lastname, 2, :username, md5(:password))');
    $request->execute([
      'firstname' => $firstName,
      'lastname' => $lastName,
      'username' => $username,
      'password' => $password
    ]);
  }
}

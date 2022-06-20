<?php
require_once '../src/common/DatabaseClient.php';

class UserModel{
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

  public function createUser($firstName, $lastName, $username, $password): void{
    $request = $this->database->prepare('INSERT INTO user(firstname, lastname, role, username, password) VALUES (:firstname, :lastname, 2, :username, md5(:password))');
    $request->execute([
      'firstname' => $firstName,
      'lastname' => $lastName,
      'username' => $username,
      'password' => $password
    ]);
  }

  public function getUserRole(string $username):int{
    $request = $this->database->prepare('SELECT role FROM user WHERE username = :username');
    $request->execute(['username' => $username]);
    $res = $request->fetch(PDO::FETCH_NUM);
    return $res[0];
  }

  public function getUserID(string $username):int{
    $request = $this->database->prepare('SELECT id FROM user WHERE username = :username');
    $request->execute(['username' => $username]);
    $res = $request->fetch(PDO::FETCH_NUM);
    return $res[0];
  }
}

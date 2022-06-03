<?php
require_once __DIR__ . '/CompteurRepository.php';
require_once __DIR__ . '/../../common/DatabaseClient.php';

class DatabaseCompteurRepository implements CompteurRepository
{
  private $database;

  public function __construct()
  {
    $this->database = DatabaseClient::getDatabase();
  }

  public function getCount(): int
  {
    $reponse = $this->database->query('SELECT value FROM counter');
    if($reponse->rowCount()==0){
      $request = $this->database->query('INSERT INTO counter(value)  values(0)');
      $valeur =0;
    }
    else $valeur = $reponse->fetch(PDO::FETCH_OBJ)->value;
    return  $valeur;
  }

  public function incrementCount(): void
  {
    
    $request = $this->database->query('UPDATE counter SET value = value + 1');
  }
}

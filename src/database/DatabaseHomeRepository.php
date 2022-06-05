<?php
require_once '../src/model/HomeRepository.php';
require_once '../src/common/DatabaseClient.php';

class DatabaseHomeRepository implements HomeRepository{
  private $database;

  public function __construct(){
    $this->database = DatabaseClient::getDatabase();
  }

  public function get5Products(){
    $sql = 'select produitID, nomProduit, prix, description, cheminimage FROM produit LIMIT 5';
    $produit = $this->database->query($sql);
    if ($produit->rowCount() >= 1) {
        return $produit->fetchAll();
    } else
        throw new Exception("Aucun produit ne correspond à l'identifiant");
  }
}

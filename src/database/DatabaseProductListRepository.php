<?php
require_once '../src/model/ProductListRepository.php';
require_once '../src/common/DatabaseClient.php';

class DatabaseProductListRepository implements ProductListRepository{
  private $database;

  public function __construct(){
    $this->database = DatabaseClient::getDatabase();
  }

  public function getAllProduit(){
    $sql = 'select produitID, nomProduit, prix, description, cheminimage FROM produit';
    $produit = $this->database->query($sql);
    if ($produit->rowCount() >= 1) {
        return $produit->fetchAll();
    } else
        throw new Exception("Aucun produit ne correspond à l'identifiant");
  }
}

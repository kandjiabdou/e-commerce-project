<?php
require_once '../src/model/ProductRepository.php';
require_once '../src/common/DatabaseClient.php';

class DatabaseProductRepository implements ProductRepository{
  private $database;

  public function __construct(){
    $this->database = DatabaseClient::getDatabase();
  }

  public function getAllProduct(){
    $sql = 'select produitID, nomProduit, prix, description, cheminimage FROM produit';
    $produit = $this->database->query($sql);
    if ($produit->rowCount() >= 1) {
        return $produit->fetchAll();
    } else
        throw new Exception("Aucun produit ne correspond à l'identifiant");
  }
  public function getProduitDetails($id){
    $sql = 'select produitID, nomProduit, prix, description, cheminimage FROM produit WHERE produitID ='.$id;
    $produit = $this->database->query($sql);
    return $produit->fetch();
   }
}

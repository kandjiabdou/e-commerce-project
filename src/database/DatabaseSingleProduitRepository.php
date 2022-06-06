<?php
require_once '../src/model/SingleProduitRepository.php';
require_once '../src/common/DatabaseClient.php';

class DatabaseSingleProduitRepository implements SingleProduitRepository{
  private $database;
  
  public function __construct(){
    $this->database = DatabaseClient::getDatabase();
  }

   public function getProduitDetails($id)
   {
    $sql = 'select produitID, nomProduit, prix, description, cheminimage FROM produit WHERE produitID ='.$id;
    $produit = $this->database->query($sql);
    return $produit->fetch();
   }
}
<?php
require_once '../src/common/DatabaseClient.php';

class PanierModel{
  private $database;

  public function __construct(){
    $this->database = DatabaseClient::getDatabase();
  }

  public function getProduitDetails($id){
    $sql = 'SELECT produitID, nomProduit, prix, description, cheminimage FROM produit WHERE produitID = :id';
    $produit = $this->database->prepare($sql);
    $produit->bindValue(':id', $id, PDO::PARAM_INT);
    $produit->execute();
    return $produit->fetch();
  }
}

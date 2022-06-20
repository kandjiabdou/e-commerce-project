<?php
require_once '../src/common/DatabaseClient.php';

class OrderModel{
  private $database;

  public function __construct(){
    $this->database = DatabaseClient::getDatabase();
  }

  public function getAllOrderbyUserId($id){
    $sql = 'select HeureAchat, nbProduit, prixTotal FROM panier where etatPanier = 1 and userID = :id;';
    $cmd = $this->database->prepare($sql);
    $cmd->bindValue(':id', $id, PDO::PARAM_INT);
    $cmd->execute();
    return $cmd->fetchAll();
  }
}

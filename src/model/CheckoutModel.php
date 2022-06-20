<?php
require_once '../src/common/DatabaseClient.php';

class CheckoutModel{
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

  public function getNextPanierID(){
    try {
      $sql = 'SELECT max(panierID) FROM `panier`;';
      $req = $this->database->prepare($sql);
      $req->execute();
      $tab = $req->fetch(PDO::FETCH_NUM);
      return $tab ? $tab[0]+1 : 1;
    } catch (PDOException $e) {
      die('Echec getNextPanierID, erreur n°' . $e->getCode() . ':' . $e->getMessage());
    }
  }

  public function insertPanier($panier){
    try {
      extract($panier);
      $idPanier = $this->getNextPanierID();
      $nbProduit = count($products);
      $sql = "INSERT INTO `panier` (`panierID`, `userID`, `etatPanier`, `nbProduit`, `prixTotal`)VALUES ( :idPanier, :idUser, '1', :nbProduit, :prixTotal);";
      $request = $this->database->prepare($sql);
      $request->execute(['idPanier' => $idPanier,'idUser' => $idUser, 'nbProduit' => $nbProduit, 'prixTotal' => $prixTotal]);

      foreach($products as $product){
        $this->insertLignePanier($idPanier, $product['produitID'], $product['quantite']);
      }

    } catch (PDOException $e) {
      die('Echec insertPanier, erreur n°' . $e->getCode() . ':' . $e->getMessage());
    }
  }

  public function insertLignePanier($idPanier,$idProduit, $quatite){
    try {
      $sql = "INSERT INTO `lignepanier` ( `panierID`, `produitID`, `quantité`) VALUES ( :idPanier, :idProduit , :quatite);";
      $request = $this->database->prepare($sql);
      $request->execute(['idPanier' => $idPanier,'idProduit' => $idProduit,'quatite' => $quatite]);
    } catch (PDOException $e) {
      die('Echec insertLignePanier, erreur n°' . $e->getCode() . ':' . $e->getMessage());
    }
  }
}

//1111111111111111

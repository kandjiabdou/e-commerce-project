<?php
require_once '../src/model/ProductRepository.php';
require_once '../src/common/DatabaseClient.php';

class DatabaseProductRepository implements ProductRepository{
  private $database;

  public function __construct(){
    $this->database = DatabaseClient::getDatabase();
  }

  public function getAllProduct(){
    $sql = 'select * FROM produit'; // produitID, nomProduit, prix, description, cheminimage
    $produit = $this->database->query($sql);
    if ($produit->rowCount() >= 1) {
        return $produit->fetchAll();
    } else
        throw new Exception("Aucun produit ne correspond à l'identifiant");
  }
  public function getProduitDetails($id){
    $sql = 'select produitID, nomProduit, prix, description, cheminimage FROM produit WHERE produitID = :id';
    $produit = $this->database->prepare($sql);
    $produit->bindValue(':id', $id, PDO::PARAM_INT);
    $produit->execute();
    return $produit->fetch();
  }

  /**
   * Retourne le nombre de produit dans la base de données
   * @return [int]
   */
  public function getNbTotalProduct(){
    try {
      $req =  $this->database->prepare('SELECT COUNT(*) FROM produit');
      $req->execute();
      $tab = $req->fetch(PDO::FETCH_NUM);
      return $tab[0];
    } catch (PDOException $e) {
      die('Echec getNbTotalProduct, erreur n°' . $e->getCode() . ':' . $e->getMessage());
    }
  }

  /**
   * Retourne les produits dans la base de données du ($offset+1)ème au ($offset + $limit) ème
   * @param [int] $offset Position de départ
   * @param [int] $limit Nombre de résultats retournés
   * @return [array] Contient la liste des Produits retournée
   */
  public function getAllProductWithLimit($offset, $nbResultatParPage){
    try {
      $sql = 'select * FROM produit ORDER BY produitID DESC LIMIT :limit OFFSET :offset';
      $produits = $this->database->prepare($sql);
      $produits->bindValue(':limit', $nbResultatParPage, PDO::PARAM_INT);
      $produits->bindValue(':offset', $offset, PDO::PARAM_INT);
      $produits->execute();
      return $produits->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Echec getAllProductWithLimit, erreur n°' . $e->getCode() . ':' . $e->getMessage());
    }
  }
}
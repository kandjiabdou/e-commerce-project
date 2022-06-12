<?php
require_once '../src/common/DatabaseClient.php';

class ProductModel{
  private $database;
  public function __construct(){
    $this->database = DatabaseClient::getDatabase();
  }

  public function getAllProduct(){
    $sql = 'SELECT * FROM produit WHERE quantiteProduit>0'; // produitID, nomProduit, prix, description, cheminimage
    $produit = $this->database->query($sql);
    if ($produit->rowCount() >= 1) {
        return $produit->fetchAll();
    } else
        throw new Exception("Aucun produit ne correspond à l'identifiant");
  }

  public function getProduitDetails($id){
    $sql = 'SELECT produitID, nomProduit, prix, description, cheminimage FROM produit WHERE produitID = :id';
    $produit = $this->database->prepare($sql);
    $produit->bindValue(':id', $id, PDO::PARAM_INT);
    $produit->execute();
    return $produit->fetch();
  }

  /**
   * Retourne le nombre de produit dans la base de données
   * @return [int]
   */
  public function getNbTotalProduct($categoryFilter, $minPrice, $maxPrice){
    
    try {
      $filter = $this->getFilterSqlString($categoryFilter, $minPrice, $maxPrice);
      $sql = 'SELECT COUNT(*) FROM produit WHERE'.$filter;
      $req =  $this->database->prepare($sql);
      if($minPrice !== false) $req->bindValue(':minPrice', $minPrice, PDO::PARAM_INT);
      if($maxPrice !== false) $req->bindValue(':maxPrice', $maxPrice, PDO::PARAM_INT);
      $req->execute();
      $tab = $req->fetch(PDO::FETCH_NUM);
      return $tab[0];
    } catch (PDOException $e) {
      die('Echec getNbTotalProduct, erreur n°' . $e->getCode() . ':' . $e->getMessage());
    }
  }

  /**
   * Retourne les produits dans la base de données du ($offset+1)ème au ($offset + $limit) ème
   * Retourne les produits dont la quatité est > 0
   * @param [int] $offset Position de départ
   * @param [int] $limit Nombre de résultats retournés
   * @return [array] Contient la liste des Produits retournée
   */
  public function getAllProductWithLimit($tri, $categoryFilter, $minPrice, $maxPrice, $offset, $nbResultatParPage){
    $filter = $this->getFilterSqlString($categoryFilter, $minPrice, $maxPrice);
    try {
      $sql = 'SELECT * FROM produit WHERE'.$filter.' ORDER BY '.$tri.' LIMIT :limit OFFSET :offset';
      $produits = $this->database->prepare($sql);
      $produits->bindValue(':limit', $nbResultatParPage, PDO::PARAM_INT);
      $produits->bindValue(':offset', $offset, PDO::PARAM_INT);
      if($minPrice !== false) $produits->bindValue(':minPrice', $minPrice, PDO::PARAM_INT);
      if($maxPrice !== false) $produits->bindValue(':maxPrice', $maxPrice, PDO::PARAM_INT);
      $produits->execute();
      return $produits->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      
      die('Echec getAllProductWithLimit, erreur n°' . $e->getCode() . ':' . $e->getMessage());
    }
  }

  /**
   * Retourne la liste des categorie la base de données
   * @return [int]
   */
  public function getCategorys(){
    try {
      $sql = 'SELECT * FROM categorie';
      $req = $this->database->prepare($sql);
      $req->execute();
      return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die('Echec getCategory, erreur n°' . $e->getCode() . ':' . $e->getMessage());
    }
  }

  public function getFilterSqlString($categoryFilter, $minPrice, $maxPrice) : string{
    $filter = ' quantiteProduit > 0';
    if($minPrice !== false) $filter .= ' AND prix > :minPrice';
    if($maxPrice !== false) $filter .= ' AND prix < :maxPrice';
    if($categoryFilter !== false) $filter .= ' AND categorieID IN (\''.join("','", $categoryFilter).'\')';
    return $filter;
  }

  public function getDefaultSort(){
    try {
      $sql = 'SELECT sortDefault FROM `config` WHERE id=1;';
      $req = $this->database->prepare($sql);
      $req->execute();
      $tab = $req->fetch(PDO::FETCH_NUM);
      return $tab[0];
    } catch (PDOException $e) {
      die('Echec getCategory, erreur n°' . $e->getCode() . ':' . $e->getMessage());
    }
  }
}
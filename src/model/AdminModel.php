<?php
require_once '../src/common/DatabaseClient.php';

class AdminModel{
  private $database;

  public function __construct(){
    $this->database = DatabaseClient::getDatabase();
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

  public function addProduct($name, $qty, $prix, $categ, $descrip): void{
    try {
      $sql = "INSERT INTO `produit` (`nomProduit`, `prix`, `description`, `cheminimage`, `categorieID`, `quantiteProduit`) ";
      $sql .= "VALUES ( :name, :prix, :descrip, 'Images/Produit/1.jpg', :categ, :qty);";
      $request = $this->database->prepare($sql);
      $request->execute([
        'name' => $name,
        'qty' => $qty,
        'prix' => $prix,
        'categ' => $categ,
        'descrip' => $descrip
      ]);
    } catch (PDOException $e) {
      die('Echec addProduct, erreur n°' . $e->getCode() . ':' . $e->getMessage());
    }
  }
}

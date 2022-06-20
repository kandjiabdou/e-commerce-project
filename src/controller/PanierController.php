<?php
require_once 'model/PanierModel.php';

class PanierController extends Controller{
  private $databasePanier;

  public function __construct(){
    parent::__construct();
    $this->databasePanier = new PanierModel();
  }

  public function action_showCart(){
    $data = [];
    if(isset($_SESSION['panier']) && sizeof($_SESSION['panier']) !== 0){
      $data['products'] = [];
      $prixtotal = 0;
      foreach($_SESSION['panier'] as $pid => $qty){
        $product = $this->databasePanier->getProduitDetails($pid);
        $product['quantite'] = $qty;
        $product['prixTotal'] = $product['prix']*$qty;
        $prixtotal += $product['prix']*$qty;
        array_push($data['products'], $product);
      }
      $data['prixTotal'] = $prixtotal;
    }
    return $this->generHtml("Panier", $data);
  }

  public function action_default(){
      return $this->action_showCart();
  }
} 
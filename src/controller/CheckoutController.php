<?php
require_once 'model/CheckoutModel.php';

class CheckoutController extends Controller{
  private $databaseCheckout;

  public function __construct(){
    parent::__construct();
    $this->databaseCheckout = new CheckoutModel();
  }

  public function action_Checkout(){
    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected']){

      $error = '';
      $values = ['name' => '', 'numcart' => '', 'year' => '', 'month' => '', 'crypto' => ''];
      $name = ''; $numcart = ''; $crypto = '';
      $panier = $this->getPanier();
      if($this->isCheckoutFormFilled()){
        $name = htmlspecialchars($_POST['name']);
        $numcart = htmlspecialchars($_POST['numcart']);
        $crypto = htmlspecialchars($_POST['crypto']);
      }
      if ($this->isCheckoutFormFilledAndValid()){
        if ($this->isCBvalid()){
          $panier['idUser'] = $_SESSION['id'];
          $this->databaseCheckout->insertPanier($panier);
          unset($_SESSION['panier']);
          $this->redirectToSinginpage();
        }else{
          $values['name'] = $name;
          $values['numcart'] = $numcart;
          $values['crypto'] = $crypto;
          $error = 'La carte refusé, essayz une autre';
        }
      } elseif($this->isOneOfTheFieldsMissing()){
        $values['name'] = $name;
        $values['numcart'] = $numcart;
        $values['crypto'] = $crypto;
        $error = 'Veuillez remplir tous les champs';
      }
      $data = [ "panier" => $panier, "values" => $values, "error" => $error];
      return $this->generHtml("Checkout", $data);

    }else $this->redirectToSinginpage();
  }

  public function action_default(){
      return $this->action_Checkout();
  }

  private function isCheckoutFormFilledAndValid(): bool{
    return $this->isCheckoutFormFilled() && $_POST['name'] !== ''
      && $_POST['numcart'] !== '' && $_POST['month'] !== ''
      && $_POST['year'] !== '' && $_POST['crypto'] !== '';
  }

  private function isCheckoutFormFilled(): bool{
    return isset($_POST['name'], $_POST['numcart'], $_POST['month'], $_POST['year'], $_POST['crypto']);
  }

  private function isOneOfTheFieldsMissing(): bool{
    return (isset($_POST['name']) && $_POST['name'] === '')
      || (isset($_POST['numcart']) && $_POST['numcart'] === '')
      || (isset($_POST['month']) && $_POST['month'] === '')
      || (isset($_POST['year']) && $_POST['year'] === '')
      || (isset($_POST['crypto']) && $_POST['crypto'] === '');
  }

  private function isCBvalid(): bool{
    return isset($_POST["numcart"]) and preg_match("#^[1-9]{16}$#", $_POST["numcart"])
      and isset($_POST["crypto"]) and preg_match("#^[1-9]{3}$#", $_POST["crypto"]);
  }

  private function getPanier(){
    $panier = [];
    if(isset($_SESSION['panier']) && sizeof($_SESSION['panier']) !== 0){
      $panier['products'] = [];
      $prixtotal = 0;
      foreach($_SESSION['panier'] as $pid => $qty){
        $product = $this->databaseCheckout->getProduitDetails($pid);
        $product['quantite'] = $qty;
        $prixtotal += $product['prix']*$qty;
        array_push($panier['products'], $product);
      }
      $panier['prixTotal'] = $prixtotal;
    }
    return $panier;
  }

  private function redirectToSinginpage(): void {
    header('Location: /e-commerce-project/src/?ctrl=Login');
    exit();
  }
} 
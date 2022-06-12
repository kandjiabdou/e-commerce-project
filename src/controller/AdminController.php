<?php
require_once 'model/AdminModel.php';

class AdminController extends Controller{
  private $databaseAdmin;
  private $data;

  public function __construct(){
    parent::__construct();
    $this->databaseAdmin = new AdminModel();
    $this->navBar = false;
    if (isset($_POST['act']) and method_exists($this, "action_" . $_POST["act"])) {
      $this->action = "action_" . $_POST["act"];
    }else{
      $this->action = "action_default";
    }
    $sort = $this->databaseAdmin->getDefaultSort();
    $categories = $this->databaseAdmin->getCategorys();
    $values = ['name' => '', 'description' => ''];
    $this->data = ['categories' => $categories,'values' => $values, 'message' => '', 'sort' => $sort ];
  }

  public function action_admin_home(){
    return $this->generHtml("Admin", $this->data);
  }

  public function action_add_product(){
    $name = ''; $qty = 0; $prix = 0; $categ = 1; $descrip = '';
    if($this->isAddForm()){
      $name = htmlspecialchars($_POST['name']);
      $qty = htmlspecialchars($_POST['quantite']);
      $prix = htmlspecialchars($_POST['prix']);
      $categ = htmlspecialchars($_POST['categorie']);
      $descrip = htmlspecialchars($_POST['description']);
    }
     
    if ($this->isAddFormFilledAndValid()){
        $this->databaseAdmin->addProduct($name, $qty, $prix, $categ, $descrip);
        $this->data['message'] = 'Le produit a été bien ajouté';
    } elseif ($this->isOneOfTheFieldsMissing()) {
      $this->data['values']['name'] = $name;
      $this->data['values']['description'] = $descrip;
      $this->data['message'] = 'Veuillez remplir tous les champs correctement';
    }
    return $this->generHtml("Admin", $this->data);
  }

  public function action_setSort(){
    if(isset($_POST['defaultSort']) and $_POST['defaultSort']>=0 and $_POST['defaultSort']<4){
      $this->databaseAdmin->setDefaultSort($_POST['defaultSort']);
      $this->data['message'] = 'le tri par défaut est bien mis à jour';
      $this->data['sort'] = $_POST['defaultSort'];
    }
    return $this->generHtml("Admin", $this->data);
  }

  public function action_default(){
      return $this->action_admin_home();
  }
  private function isAddForm(): bool{
    return isset($_POST['name'], $_POST['quantite'], $_POST['prix'], $_POST['categorie'], $_POST['description']);
  }
  private function isOneOfTheFieldsMissing(): bool{
    return (isset($_POST['name']) && !empty($_POST['name']))
      || (isset($_POST['quantite']) && $_POST['quantite'] === '')
      || (isset($_POST['prix']) && $_POST['prix'] === '')
      || (isset($_POST['categorie']) && $_POST['categorie'] === '')
      || (isset($_POST['description']) && !empty($_POST['description']));
  }

  private function isAddFormFilledAndValid(): bool{
    return $this->isAddForm()
      && strlen(trim($_POST['name'])) > 0
      && $_POST['quantite'] >= 0
      && $_POST['prix'] >= 0
      && $_POST['categorie'] > 0
      && $_POST['categorie'] < 5
      && strlen(trim($_POST['description'])) > 0;
  }
} 
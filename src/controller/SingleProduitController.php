<?php
require_once 'database/DatabaseSingleProduitRepository.php';

class SingleProduitController extends Controller{
    private $singleRepository;

  public function __construct(){
    parent::__construct();
    $this->singleRepository = new DatabaseSingleProduitRepository();

  }

  public function action_SingleProduit(){
    if (isset($_GET['produitID']))
    {
        $data = $this->singleRepository->getProduitDetails($_GET['produitID']);
    }
    return $this->generHtml("SingleProduit", $data);
  }

  public function action_default(){
      return $this->action_home();
  }
}
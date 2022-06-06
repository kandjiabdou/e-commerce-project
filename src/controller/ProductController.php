<?php
require_once 'database/DatabaseProductRepository.php';

class ProductController extends Controller{
  private $productRepository;

  public function __construct(){
    parent::__construct();
    $this->productRepository = new DatabaseProductRepository();
  }

  public function action_allProduct(){
    $data = $this->productRepository->getAllProduct();
    return $this->generHtml("AllProduct", $data);
  }

  public function action_SingleProduit(){
    if (isset($_GET['produitID']))
    {
        $data = $this->productRepository->getProduitDetails($_GET['produitID']);
    }
    return $this->generHtml("SingleProduit", $data);
  }

  public function action_default(){
      return $this->action_allProduct();
  }
  /*
  public function action_pagination(){
        $start = 1;
        if (isset($_GET["start"]) and preg_match("#^\d+$#", $_GET["start"]) and $_GET["start"] > 0) {
            $start = $_GET["start"];
        }
        
        $m = Model::getModel();
        
            
        //Récupération du nombre total de prix nobel
        $nb_nobels = $m->getNbNobelPrizes();
        
        $nb_total_pages = ceil($nb_nobels / NB_RESULTATS_PAR_PAGE);
        if ($nb_total_pages < $start) {
            $this->action_error("The page does not exist!");
        }


        //Détermination du premier résultat à récupérer dans la base de données
        $offset = ($start - 1 ) * NB_RESULTATS_PAR_PAGE ;

        $data = [
            //Nb prix nobels
            'nb_total_pages' => $nb_total_pages,

             //indice de la page de résultats visualisée
            'active' => $start,

            //Récupération des prix nobel de la page $start
            'liste'  => $m->getNobelPrizesWithLimit($offset, NB_RESULTATS_PAR_PAGE),

            //Récupération des urls des pages
            'links'  => liste_pages($start, $nb_total_pages),
        ];
        
        //Affichage de la vue
        $this->render("pagination", $data);
    }*/
}
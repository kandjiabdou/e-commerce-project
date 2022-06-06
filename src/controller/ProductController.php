<?php
require_once 'database/DatabaseProductRepository.php';

class ProductController extends Controller{
  private $productRepository;
  private int $NB_PRODUIT_PAR_PAGE = 10;

  public function __construct(){
    parent::__construct();
    $this->productRepository = new DatabaseProductRepository();
  }

  public function action_SingleProduit(){
    $data = false;
    if (isset($_GET["produitID"]) and preg_match("#^[1-9]\d*$#", $_GET["produitID"])) {
      $data = $this->productRepository->getProduitDetails($_GET['produitID']);
    }
    //Si on a bien un produit d'identifiant$_GET["id"]
    if ($data !== false) {
      return $this->generHtml("SingleProduit", $data);
    } else {
      return $this->action_error("Il n'y a pas de produit avec l'ID donné!!!");
    }
  }

  public function action_allProduct(){
    $start = 1;
    if (isset($_GET["start"]) and preg_match("#^\d+$#", $_GET["start"]) and $_GET["start"] > 0) {
        $start = $_GET["start"];
    }
            
    //Récupération du nombre total de produit
    $nbProducts = $this->productRepository->getNbTotalProduct();
    
    $nb_total_pages = ceil($nbProducts / $this->NB_PRODUIT_PAR_PAGE);
    if ($nb_total_pages < $start) {
        $this->action_error("The page does not exist!");
    }

    //Détermination du premier résultat à récupérer dans la base de données
    $offset = ($start - 1 ) * $this->NB_PRODUIT_PAR_PAGE ;

    $data = [
        //Nb de pages de produit à afficher
        'nb_total_pages' => $nb_total_pages,
        //indice de la page de résultats visualisée
        'active' => $start,
        //Récupération les produits de la page $start
        'products'  => $this->productRepository->getAllProductWithLimit($offset, $this->NB_PRODUIT_PAR_PAGE),
        // La listes des catégorie sur le site
        'categorys' => $this->productRepository->getCategorys(),
        //Récupération des urls des pages
        'listPages'  => $this->liste_pages($start, $nb_total_pages),
    ];
    
    //Retourner la vue
    return $this->generHtml("AllProduct", $data);
  }

  public function action_default(){
    return $this->action_allProduct();
  }

  /**
   * Récupère sous forme de tableau les numéros de pages à afficher dans un affichage avec pagination
   * @param  int $page_active    page qui va être affichée
   * @param  int $nb_total_pages nombre total de pages de résultats
   * @return array Contient les numéros de page qui seront affichés
   */
  function liste_pages($page_active, $nb_total_pages){
    $debut = max($page_active - 5, 1);
    if ($debut === 1) {
        $fin = min(10, $nb_total_pages);
    } else {
        $fin = min($page_active + 4, $nb_total_pages);
    }
    $pages = [];
    for ($i = $debut; $i <= $fin; $i++) {
        $pages[] = $i ;
    }
    return $pages;
  }
}
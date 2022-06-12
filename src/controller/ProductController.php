<?php
require_once 'model/ProductModel.php';

class ProductController extends Controller{
  private $databaseProduct;
  private $NB_PRODUIT_PAR_PAGE = 10;

  public function __construct(){
    parent::__construct();
    $this->databaseProduct = new ProductModel();
  }

  public function action_SingleProduit(){
    $data = false;
    if (isset($_GET["produitID"]) and preg_match("#^[1-9]\d*$#", $_GET["produitID"])) {
      $data = $this->databaseProduct->getProduitDetails($_GET['produitID']);
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
    
    $categoryFilter = false; 
    if(isset($_GET["categoryList"])){
      $categoryFilter = $_GET["categoryList"]; 
    }
    $minPrice = false;
    $maxPrice = false;
    if(isset($_GET["min"]) and preg_match("#^\d+$#", $_GET["min"]) and $_GET["min"] > 0){
      $minPrice = $_GET["min"]; 
    }
    if(isset($_GET["max"]) and preg_match("#^\d+$#", $_GET["max"]) and $_GET["max"] > 0){
      $maxPrice = $_GET["max"]; 
    }

    $tri = "nomProduit ASC";
    $tris = ["nomProduit ASC","nomProduit DESC", "prix ASC", "prix DESC"];
    $sort = $this->databaseProduct->getDefaultSort();
    if(isset($_GET["sort"]) and $_GET["sort"]>= 0 and $_GET["sort"]<4){
      $tri = $tris[$_GET["sort"]];
      $sort = $_GET["sort"];
    } 

    //Récupération du nombre total de produit
    $nbProducts = $this->databaseProduct->getNbTotalProduct($categoryFilter, $minPrice, $maxPrice);
    
    $nb_total_pages = ceil($nbProducts / $this->NB_PRODUIT_PAR_PAGE);
    if ($nb_total_pages < $start) $start = 1;

    //Détermination du premier résultat à récupérer dans la base de données
    $offset = ($start - 1 ) * $this->NB_PRODUIT_PAR_PAGE ;

    $data = [
        //Nb de pages de produit à afficher
        'nb_total_pages' => $nb_total_pages,
        //indice de la page de résultats visualisée
        'active' => $start,
        //Récupération les produits de la page $start
        'products'  => $this->databaseProduct->getAllProductWithLimit($tri, $categoryFilter, $minPrice, $maxPrice, $offset, $this->NB_PRODUIT_PAR_PAGE),
        // La listes des catégorie sur le site
        'categorys' => $this->databaseProduct->getCategorys(),
        // La listes des catégorie sur le filtre
        'categoryFilter' => $categoryFilter,
        // le prix min à afficher
        'minPrice' => $minPrice,
        // le prix max à afficher
        'maxPrice' => $maxPrice,
        // trier par ordre
        'sort' => $sort,
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
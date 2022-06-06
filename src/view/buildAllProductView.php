<?php

function buildAllProductView($data): string
{
  /* data contient :
  nb_total_pages : nombre de produit
  active : indice de la page de résultats visualisée
  products : tableau de produit
  listPages : liste des urls des pages
  */
  extract($data);
  $breadcrumb = breadcrumb();
  $filtre = filtre();
  $script = script();
  $btnFitre = btnFiltre();
  $trier = trier();
  $listProducts = allProducts($products);
  $pagination = pagination($listPages, $active, $nb_total_pages);

  return <<<HTML
    <!-- breadcrumb -->
    $breadcrumb
    <div id="content" class="products_page">
      <!-- products -->
      <div id="products" class="products_section">
        <div class="container-fluid">
          <div class="row">
            <div id="filterProduct" class="col-sm-3 cd-filter">
            <!--Filtre-->
              $filtre
            </div> <!-- cd-filter -->
            <!--script-->
            $script
            <div id="ProductList" class="col-sm-9">
              <div class="eb_left">
                <div class="product-list-top">
                  <!-- Boutton filtre -->
                  $btnFitre
                  <!-- Trier -->
                  $trier
                  <div class="clear"></div>
                </div>
                <!-- single product-list -->
                <!--1 : allProduct-->
                $listProducts
                <!-- Pagination -->
                $pagination
              </div>
            </div>

          </div>
        </div>
      </div>
	</div>
HTML;
}
function breadcrumb(){
  return <<<HTML
  <section class="main_breadcrumb">
		<div class="container-fluid">
			<div class="row">
				<div class="breadcrumb-content">
					<h2>products</h2>
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="">products</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
HTML;
}
function pagination($listPages, $active, $max_pages){
  $render = '';
  if($active>1){
    $render.= '<a href="?controller=Product&action=allProduct&start='.($active -1).'" class="prev page-numbers"><i class="fa fa-angle-left"></i></a>';
  }
  foreach($listPages as $page){
    $render.='<a href="?controller=Product&action=allProduct&start='.($page).'" class="page-numbers">';
    $render.= $page == $active ? '<span class="page-numbers current" aria-current="page">'.($page).'</span>' : $page;
    $render.='</a>';
  }
  if($active < $max_pages){
    $render.= '<a href="?controller=Product&action=allProduct&start='.($active +1).'" class="next page-numbers"><i class="fa fa-angle-right"></i></a>';
  }
  return <<<HTML
  <div class="clear"></div>
  <div class="pagination-section text-center wow fadeInDown animated">
    $render
  </div>
HTML;
}
function filtre(){
  return <<<HTML
    <form>
      <div class="cd-filter-block">
        <h4>Check boxes</h4>
        <ul class="cd-filter-content cd-filters list">
          <li>
            <input class="filter" data-filter=".check1" type="checkbox" id="checkbox1">
            <label class="checkbox-label" for="checkbox1">Telephne</label>
          </li>
          <li>
            <input class="filter" data-filter=".check2" type="checkbox" id="checkbox2">
            <label class="checkbox-label" for="checkbox2">Ordinateur</label>
          </li>
        </ul> <!-- cd-filter-content -->
      </div> <!-- cd-filter-block -->

      <div class="cd-filter-block">
        <h4>Prix</h4>
        <ul class="cd-filter-content cd-filters list">
          <li><label class="form-label" for="typeNumber">Minimum</label></li>
          <li>
            <div class="col-md-3 mt-3 text-center">
              <div class="form-outline">
                <input type="number" id="typeNumber" class="form-control active"
                  value="">
              </div>
          </li>
          <li><label class="form-label" for="typeNumber2">Maximum</label></li>
          <li>
            <div class="col-md-3 mt-3 text-center">
              <div class="form-outline">
                <input type="number" id="typeNumber2" class="form-control active"
                  value="">
              </div>
          </li>
        </ul>
      </div>
      <button type="button" class="btn wow fadeInDown animated" onclick="" title="Add to Cart"><span><i class="fa fa-check"></i> Appliquer</span></button>
    </form>
HTML;
}

function trier(){
  return <<<HTML
  <div class="sort-by-wrapper">
    <div class="col-md-9 col-xs-3 sort">
      <div class="form-group input-group input-group-sm wow fadeInDown pull-right">
        <label class="input-group-addon" for="input-sort">Sort By:</label>
        <div class="select-wrapper">
          <select id="input-sort" class="form-control">
            <option value="" selected="selected">Default</option>
            <option value="">Nom (A - Z)</option>
            <option value="">Nom (Z - A)</option>
            <option value="">Prix - croissant</option>
            <option value="">Prix - décroissant</option>
          </select>
        </div>
      </div>
    </div>
  </div>
HTML;
}

function script(){
  return <<<HTML
  <script>
    function ShowAndHideFilter() {
      var x = document.getElementById('filterProduct');
      var c = document.getElementById('ProductList');
      if (x.style.display == 'none') {
        x.style.display = 'block';
        c.className = "col-sm-9";
      } else {
        x.style.display = 'none';
        c.className = "col-sm-12";
      }
    }
  </script>
HTML;
}
function btnFiltre(){
  return <<<HTML
  <div class="show-wrapper">
    <div class="col-md-3 col-xs-3">
      <div class="form-group input-group input-group-sm wow fadeInDown pull-left">
          <button type="button" class="btn wow fadeInDown animated" onclick="ShowAndHideFilter()" title="Add to Cart"><span><i class="fa fa-filter"></i> Filtre</span></button>
      </div>
    </div>
  </div>
HTML;
}

function allProducts($allProducts){
  $render = '';
  if (empty($allProducts)) {
    $render = '<strong>Aucun produit dans cette sous catégorie</strong>';
  } else {
    foreach ($allProducts as $product) {
      $newPrice = $product['prix']*0.85;
      $render .= '<div class="col-sm-4">
        <div class="product-thumb">
          <div class="image wow fadeInDown animated">
            <a href="?controller=Product&action=SingleProduit&produitID='.$product['produitID'].'">
              <img class="wow fadeInDown animated imgProduct" src="'.$product['cheminimage'].'" alt="'.$product['nomProduit'].'" title="'.$product['nomProduit'].'" width="100%">
            </a>
          </div>
          <div class="caption">
            <div class="rate-and-title">
              <h4 class="wow fadeInDown animated"><a href="">'.$product['nomProduit'].'</a>
              </h4>
              <p class="price wow fadeInDown animated"><span
                  class="price-old">'.$product['prix'].'</span> <span
                  class="price-new">'.$newPrice.'</span></p>
              <button type="button" class="btn wow fadeInDown animated" onclick=""
                title="Add to Cart"><span><i class="fa fa-shopping-cart"></i> Add to
                  Cart</span></button>
            </div>
          </div>
        </div>
      </div>';
    }
  }
  return $render;
}
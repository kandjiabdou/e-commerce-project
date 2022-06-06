<?php

function buildAllProductView($data): string
{
  /* data contient :
  nb_total_pages : nombre de produit
  active : indice de la page de résultats visualisée
  products : tableau de produit
  categorys : tableau de gatecories
  listPages : liste des urls des pages
  */
  extract($data);
  $breadcrumb = breadcrumb();
  $filtre = filtre($categorys);
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
function filtre($categorys){
  $htmlCategory = '';
  foreach($categorys as $category){
    $htmlCategory.='<li>
      <input class="filter" data-filter=".check'.$category['categorieID'].'" type="checkbox" id="checkbox'.$category['categorieID'].'">
      <label class="checkbox-label" for="checkbox'.$category['categorieID'].'">'.$category['nomCategorie'].'</label>
    </li>';
  }
  return <<<HTML
    <form class="eb-form eb-mailform form-filter" novalidate="novalidate">      <div class="row">
        <div class="col-sm-12">
          <h4>Catégories</h4>
        </div>
        <ul id="ul-filter">
          $htmlCategory
        </ul> <!-- cd-filter-content -->
        <div class="col-sm-12">
          <h4>Prix</h4>
        </div>
        <div class="col-sm-6">
          <div class="form-wrap has-error">
            <input class="form-input form-control" id="checkout-first-name-1" type="number"
              name="name" data-constraints="@Required" placeholder="Minimum">
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-wrap has-error">
            <input class="form-input form-control" id="checkout-last-name-1" type="number"
              name="name" data-constraints="@Required" placeholder="Minimum">
          </div>
        </div>
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
        <label class="input-group-addon" for="input-sort">Trier par:</label>
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
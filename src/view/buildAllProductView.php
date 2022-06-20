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
  $filtre = filtre($sort, $categorys, $minPrice, $maxPrice, $categoryFilter);
  $btnFitre = btnFiltre();
  $trier = trier($sort, $minPrice, $maxPrice, $categoryFilter);
  $listProducts = allProducts($products);
  $pagination = pagination($sort, $listPages, $active, $nb_total_pages, $minPrice, $maxPrice, $categoryFilter);

  return <<<HTML
    <!-- breadcrumb -->
    <div id="err"><div>
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
                <div id="product_group">
                  $listProducts
                </div>
                
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
					<h2>Produits</h2>
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="">produits</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
HTML;
}
function pagination($sort, $listPages, $active, $max_pages, $minPrice, $maxPrice, $categoryFilter){
  $render = '';
  //
  $filter = 'sort='.$sort;
  if($minPrice !== false) $filter .= '&min='.$minPrice;
  if($maxPrice !== false) $filter .= '&max='.$maxPrice;
  if($categoryFilter !== false){
    foreach($categoryFilter as $category){
      $filter .= '&categoryList%5B%5D='.$category;
    }
  }
  if($active>1){
    $render.= '<a href="?'.$filter.'&ctrl=Product&act=allProduct&start='.($active -1).'" class="prev page-numbers"><i class="fa fa-angle-left"></i></a>';
  }
  foreach($listPages as $page){
    $render.='<a href="?'.$filter.'&ctrl=Product&act=allProduct&start='.($page).'" class="page-numbers">';
    $render.= $page == $active ? '<span class="page-numbers current" aria-current="page">'.($page).'</span>' : $page;
    $render.='</a>';
  }
  $render.= '<a href="?'.$filter.'&ctrl=Product&act=allProduct&start='.($active == $max_pages? 1 : $active + 1).'" class="next page-numbers"><i class="fa fa-angle-right"></i></a>';
  return <<<HTML
  <div class="clear"></div>
  <div class="pagination-section text-center wow fadeInDown animated">
    $render
  </div>
HTML;
}
function filtre($sort, $categorys, $minPrice, $maxPrice, $categoryFilter){
  $htmlCategory = '';
  foreach($categorys as $category){
    $check = ($categoryFilter !== false and in_array($category['categorieID'], $categoryFilter)) ? 'checked' : '';
    $htmlCategory.='<li>
      <input class="filter" type="checkbox" name="categoryList[]" value="'.$category['categorieID'].'" '.$check.'>
      <label class="checkbox-label">'.$category['nomCategorie'].'</label>
    </li>';
  }
  $minPrice = $minPrice !== false ? 'value ="'.$minPrice.'" ' : '';
  $maxPrice = $maxPrice !== false ? 'value ="'.$maxPrice.'" ' : '';
  $htmlSort = '<input type="hidden" name="sort" value="'.$sort.'">';
  return <<<HTML
    <form action="" method="get">
      <div class="row">
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
            <input class="form-input form-control" type="number" name="min" placeholder="Minimum" $minPrice>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-wrap has-error">
            <input class="form-input form-control" type="number" name="max" placeholder="Maximum" $maxPrice>
          </div>
        </div>
      </div>
      <div id="btnFilterSubmit" class="col-sm-6">
        <button type="submit" class="btn ">
          Appliquer
        </button>      
        </div>
      <input type="hidden" name="ctrl" value="Product">
      <input type="hidden" name="act" value="allProduct">
      $htmlSort
    </form>
HTML;
}

function trier( $sort, $minPrice, $maxPrice, $categoryFilter){
  $filter='';
  if($minPrice !== false) $filter .= '<input type="hidden" name="min" value="'.$minPrice.'">';
  if($maxPrice !== false) $filter .= '<input type="hidden" name="max" value="'.$maxPrice.'">';
  if($categoryFilter !== false){
    foreach($categoryFilter as $category){
      $filter .= '<input type="hidden" name="categoryList[]" value="'.$category.'">';
    }
  }
  $optionList = '';
  $listSort = ["Nom (A - Z)", "Nom (Z - A)", "Prix - croissant", "Prix - décroissant"];
  for($i=0; $i<4; $i++){
    $optionList .='<option value="'.$i.'" '.($i == $sort ? 'selected="selected"' : '').' >'.$listSort[$i].'</option>';
  }
  return <<<HTML
  <div class="sort-by-wrapper">
    <div class="col-md-9 col-xs-3 sort">
      <div class="form-group input-group input-group-sm wow fadeInDown pull-right">
        <label class="input-group-addon" for="input-sort">Trier par:</label>
        <div class="select-wrapper">
          <form action="" method="get">
            <select name="sort" class="form-control" onchange="this.form.submit()">
              $optionList
            </select>
            <input type="hidden" name="ctrl" value="Product">
            <input type="hidden" name="act" value="allProduct">
            $filter
          </form>
        </div>
      </div>
    </div>
  </div>
HTML;
}

function btnFiltre(){
  return <<<HTML
  <div class="show-wrapper">
    <div class="col-md-3 col-xs-3">
      <div class="form-group input-group input-group-sm wow fadeInDown pull-left">
          <button type="button" class="btn wow fadeInDown animated" onclick="ShowAndHideFilter()" title="Filtre">
          <span id="filterLeftRight"><i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></span>
          <span> Filtre <i class="fa fa-filter"></i></span>
          </button>
      </div>
    </div>
  </div>
HTML;
}

function allProducts($allProducts){
  $render = '';
  if (empty($allProducts)) {
    $render = '<strong>Aucun produit trouvé</strong>';
  } else {
    foreach ($allProducts as $product) {
      $newPrice = $product['prix']*1.15;
      $render .= '<div class="single_product col-sm-4">
        <div class="image wow fadeInDown animated">
          <a href="?ctrl=Product&act=SingleProduit&produitID='.$product['produitID'].'">
            <img class="wow fadeInDown animated imgProduct" src="assets/image/'.$product['cheminimage'].'" alt="'.$product['nomProduit'].'" title="'.$product['nomProduit'].'" width="100%">
          </a>
        </div>
        <div class="caption">
          <div class="rate-and-title">
            <h4 class="wow fadeInDown animated"><a href="?ctrl=Product&act=SingleProduit&produitID='.$product['produitID'].'">'.$product['nomProduit'].'</a>
            </h4>
            <p class="price wow fadeInDown animated"><span
                class="price-old">'.$newPrice.'</span> <span
                class="price-new">'.$product['prix'].'</span></p>
            <button value="'.$product['produitID'].'" type="button" class="btn_ajout_panier btn wow fadeInDown animated"
              title="Ajouter au panier"><span><i class="fa fa-shopping-cart"></i> Ajouter au panier </span></button>
          </div>
        </div>
      </div>';
    }
  }
  return $render;
}
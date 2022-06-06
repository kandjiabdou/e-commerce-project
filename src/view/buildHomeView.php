<?php
function buildHomeView($productList): string{
    $sectionSlider = buildSectionSliderView();
    $mainTitle = buildMainTitleView();
    $productsSlider = buildproductSliderView($productList);
  return <<<HTML
    $sectionSlider
    $mainTitle
    <!-- Our products  -->
	<div id="products" class="products_section">
		<div class="container-fluid">
			<div class="heading_wrapper wow fadeInDown animated">
				<h2 class="wow fadeInDown animated">Notre sélection pour vous</h2>
				<p class="wow fadeInDown animated">Lorem Ipsum is simply dummy text of the printing and typesetting
					industry. Lorem Ipsum has been the industry's standard dummy text </p>
			</div>
			<div class="row">
				<div id="product" class="owl-carousel owl-theme">
					<!--1 -->
					$productsSlider
					<!-- products end -->
				</div>
			</div>
		</div>
		<!-- Products End-->
	</div>
HTML;
}
function buildSectionSliderView(): string{
  return <<<HTML
    <section>
		<div id="slideWiz" class="slideWiz" style="width: 100%; height: 500px;"></div>
	</section>
HTML;
}
function buildMainTitleView(): string{
    return <<<HTML
      <section class="main_breadcrumb">
        <div class="container-fluid">
            <div class="row">
                <div class="breadcrumb-content">
                    <h2><a href="products.html">Voir tous les produits</a></h2>
                </div>
            </div>
        </div>
      </section>
  HTML;
}
function buildproductSliderView($productList): string{
    $render = '';
    if (empty($productList)) {
        $render = '<strong>Aucun produit dans cette sous catégorie</strong>';
    } else {
        foreach ($productList as $product) {
            $newPrice = $product['prix']*0.85;
            $render .= '<div class="item">
                <div class="col-sm-12">
                    <div class="product-thumb">
                        <div class="image wow fadeInDown animated">
                            <a href="?controller=SingleProduit&action=SingleProduit&produitID='.$product['produitID'].'"><img class="wow fadeInDown animated"
                                    src="'.$product['cheminimage'].'" alt="Kundli Dosha"
                                    title="Kundli Dosha" width="100%"></a>
                        </div>
                        <div class="caption">
                            <div class="rate-and-title">
                                <h4 class="wow fadeInDown animated"><a href="single-products.html">'.$product['nomProduit'].'</a></h4>
                                <p class="price wow fadeInDown animated">
                                    <span class="price-old">'.$product['prix'].'</span>
                                    <span class="price-new">'.$newPrice.'</span>
                                </p>
                                <button type="button" class="btn wow fadeInDown animated" onclick=""
                                    title="Add to Cart"><span><i class="fa fa-shopping-cart"></i> Add to
                                        Cart</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }

    return <<<HTML
        $render
    HTML;
}
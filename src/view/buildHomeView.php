<?php

function buildHomeView($productList): string
{

  return <<<HTML
    <section>
		<div id="slideWiz" class="slideWiz" style="width: 100%; height: 500px;"></div>
	</section>

	<section class="main_breadcrumb">
		<div class="container-fluid">
			<div class="row">
				<div class="breadcrumb-content">
					<h2><a href="products.html">Voir tous les produits</a></h2>
				</div>
			</div>
		</div>
	</section>
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
					<div class="item">
						<div class="col-sm-12">
							<div class="product-thumb">
								<div class="image wow fadeInDown animated">
									<a href="single-products.html"><img class="wow fadeInDown animated"
											src="assets/image/category/product-1.jpg" alt="Kundli Dosha"
											title="Kundli Dosha" width="100%"></a>
								</div>
								<div class="caption">
									<div class="rate-and-title">
										<h4 class="wow fadeInDown animated"><a href="single-products.html">Natural
												Mineral Stone</a></h4>
										<p class="price wow fadeInDown animated"><span class="price-old">$123.20</span>
											<span class="price-new">$110.00</span>
										</p>
										<button type="button" class="btn wow fadeInDown animated" onclick=""
											title="Add to Cart"><span><i class="fa fa-shopping-cart"></i> Add to
												Cart</span></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- 2-->
					<div class="item">
						<div class="col-sm-12">
							<div class="product-thumb">
								<div class="image wow fadeInDown animated">
									<a href="single-products.html"><img class="wow fadeInDown animated"
											src="assets/image/category/product-2.jpg" alt="Kundli Dosha"
											title="Kundli Dosha" width="100%"></a>
								</div>
								<div class="caption">
									<div class="rate-and-title">
										<h4 class="wow fadeInDown animated"><a href="single-products.html">Natural
												Mineral Stone</a></h4>
										<p class="price wow fadeInDown animated"><span class="price-old">$123.20</span>
											<span class="price-new">$110.00</span>
										</p>
										<button type="button" class="btn wow fadeInDown animated" onclick=""
											title="Add to Cart"><span><i class="fa fa-shopping-cart"></i> Add to
												Cart</span></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- 3-->
					<div class="item">
						<div class="col-sm-12">
							<div class="product-thumb">
								<div class="image wow fadeInDown animated">
									<a href="single-products.html"><img class="wow fadeInDown animated"
											src="assets/image/category/product-2.jpg" alt="Kundli Dosha"
											title="Kundli Dosha" width="100%"></a>
								</div>
								<div class="caption">
									<div class="rate-and-title">
										<h4 class="wow fadeInDown animated"><a href="single-products.html">Natural
												Mineral Stone</a></h4>
										<p class="price wow fadeInDown animated"><span class="price-old">$123.20</span>
											<span class="price-new">$110.00</span>
										</p>
										<button type="button" class="btn wow fadeInDown animated" onclick=""
											title="Add to Cart"><span><i class="fa fa-shopping-cart"></i> Add to
												Cart</span></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--4 -->
					<div class="item">
						<div class="col-sm-12">
							<div class="product-thumb">
								<div class="image wow fadeInDown animated">
									<a href="single-products.html"><img class="wow fadeInDown animated"
											src="assets/image/category/product-2.jpg" alt="Kundli Dosha"
											title="Kundli Dosha" width="100%"></a>
								</div>
								<div class="caption">
									<div class="rate-and-title">
										<h4 class="wow fadeInDown animated"><a href="single-products.html">Natural
												Mineral
												Stone</a></h4>
										<p class="price wow fadeInDown animated"><span class="price-old">$123.20</span>
											<span class="price-new">$110.00</span>
										</p>
										<button type="button" class="btn wow fadeInDown animated" onclick=""
											title="Add to Cart"><span><i class="fa fa-shopping-cart"></i> Add to
												Cart</span></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--5 -->
					<div class="item">
						<div class="col-sm-12">
							<div class="product-thumb">
								<div class="image wow fadeInDown animated">
									<a href="single-products.html"><img class="wow fadeInDown animated"
											src="assets/image/category/product-2.jpg" alt="Kundli Dosha"
											title="Kundli Dosha" width="100%"></a>
								</div>
								<div class="caption">
									<div class="rate-and-title">
										<h4 class="wow fadeInDown animated"><a href="single-products.html">Natural
												Mineral
												Stone</a></h4>
										<p class="price wow fadeInDown animated"><span class="price-old">$123.20</span>
											<span class="price-new">$110.00</span>
										</p>
										<button type="button" class="btn wow fadeInDown animated" onclick=""
											title="Add to Cart"><span><i class="fa fa-shopping-cart"></i> Add to
												Cart</span></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- products end -->
				</div>
			</div>
		</div>
		<!-- Products End-->
	</div>
HTML;
}

/*
function buildHomeView($productList): string
{
  $render = '';
  if (empty($productList)) {
    $render = '<strong>Aucun produit dans cette sous catégorie</strong>';
  } else {
    foreach ($productList as $product) {
        $render .= '<div class="produit_list">
            <div class="image_produit">
                <a href="">
                    <img class="display" src='.$product['cheminimage'].' alt="image produit"/>
                </a>
            </div>
            <div class="content_produit">
                <a href="">
                    <span><strong>'.$product['nomProduit'].'</strong></span></a>
                <hr>
                <span class="description">'.$product['description'].'</span>
            </div>
        </div>';
    }
  }

  return <<<HTML
    <div>
      $render
    </div>
HTML;
}
*/
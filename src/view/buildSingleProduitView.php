<?php

function buildSingleProduitView($produit): string
{
	$nom = $produit['nomProduit'];
	$des= $produit['description'];
	$prix=$produit['prix'];
	$prix_reduct=$produit['prix']*0.85;

	$cheminimage=$produit['cheminimage'];
    return <<<HTML
    <div id="content" class="single_products_page">
		<!-- single products page -->
		<div id="products_products" class="single_products_section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<div class="eb_right single_products_right_side">
							<div class="single_products_images">
								<div class="single_product_image">
									<div class="sp-loading">
										<img src="$cheminimage" alt="" width="100%">
									</div>
								</div>

								<div class="sp-wrap">
									<div id="additional_silder_products_images" class="owl-carousel">
										<div class="item">
											<a href="assets/image/products/product-1.jpg">
												<img src="assets/image/products/product-2.jpg" alt="">
											</a>
										</div>
										<div class="item">
											<a href="assets/image/products/product-3.jpg">
												<img src="assets/image/products/product-4.jpg" alt="">
											</a>
										</div>
										<div class="item">
											<a href="assets/image/products/product-5.jpg">
												<img src="assets/image/products/product-6.jpg" alt="">
											</a>
										</div>
										<div class="item">
											<a href="assets/image/products/product-7.jpg">
												<img src="assets/image/products/product-8.jpg" alt="">
											</a>
										</div>
										<div class="item">
											<a href="assets/image/products/product-9.jpg">
												<img src="assets/image/products/product-10.jpg" alt="">
											</a>
										</div>
										<div class="item">
											<a href="assets/image/products/product-11.jpg">
												<img src="assets/image/products/product-12.jpg" alt="">
											</a>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="col-sm-6">
						<div class="eb_left single_products_left_side">
							<h2>$nom</h2>

							<hr>
							<div class="price-block">
								<div class="price-box">
									<p class="in-stock"><i class="fa fa-check"></i> In Stock</p>
									<p class="special-price"> <span class="price-label">Special Price</span> <span
											id="product-price-48" class="price"> $prix_reduct</span> </p>
									<p class="old-price"> <span class="price-label">Regular Price:</span> <span
											class="price"> $prix</span> </p>
								</div>
							</div>

							<div class="add-to-box">
								<div class="add-to-cart">
									<div class="pull-left">
										<div class="custom pull-left">
											<button
												onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) && qty > 0 ) result.value--;return false;"
												class="reduced items-count" type="button"><i
													class="fa fa-minus">&nbsp;</i></button>
											<input type="text" class="input-text qty" title="Qty" value="1"
												maxlength="12" id="qty" name="qty">
											<button
												onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
												class="increase items-count" type="button"><i
													class="fa fa-plus">&nbsp;</i></button>
										</div>
									</div>
									<button onclick="productAddToCartForm.submit(this)" class="btn btn-cart"
										title="Add to Cart" type="button">Add to Cart</button>
								</div>
							</div>

							<div class="short-description">
								<h3>overview</h3>
								<p>$des</p>
							</div>

							<ul class="shipping-pro">
								<li>Free Wordwide Shipping</li>
								<li>30 Days Return</li>
								<li>Member Discount</li>
							</ul>

						</div>
					</div>
				</div>

				<!-- relative products  end-->

			</div>
		</div>
	</div>
HTML;
}

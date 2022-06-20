<?php

function buildSingleProduitView($produit): string
{
	$nom = $produit['nomProduit'];
	$des= $produit['description'];
	$prix=$produit['prix'];
	$prix_reduct=$produit['prix']*0.85;

	$cheminimage=$produit['cheminimage'];
	$pid=$produit['produitID'];
    return <<<HTML
    <div id="content" class="single_products_page">
		<!-- single products page -->
		<div id="products_products" class="single_products_section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-5">
						<div class="eb_right single_products_right_side">
							<div class="single_products_images">
								<div class="single_product_image">
									<div class="sp-loading">
										<img src="assets/image/$cheminimage" alt="" width="100%">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-7">
						<div class="eb_left single_products_left_side">
							<h2>$nom</h2>

							<hr>
							<div class="price-block">
								<div class="price-box">
									<p class="in-stock"><i class="fa fa-check"></i> En Stock</p>
									<p class="old-price"> <span class="price-label">Special Price</span>
									<span class="price"> $prix_reduct</span> </p>
									<p class="special-price"> <span class="price-label">Regular Price:</span>
									<span id="product-price-48" class="price"> $prix</span> </p>
								</div>
							</div>

							<div class="add-to-box">
								<div class="add-to-cart">
									<button value="$pid" class="btn_ajout_panier btn btn-cart" title="Ajouter au panier" type="button">Ajouter au panier</button>
								</div>
							</div>

							<div class="short-description">
								<h3>Description du produit</h3>
								<p>$des</p>
							</div>

							<ul class="shipping-pro">
								<li>Livraison gratuite</li>
								<li>30 jours de retour</li>
								<li>Promo pour les membres</li>
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

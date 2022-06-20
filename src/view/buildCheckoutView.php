<?php
function buildCheckoutView($data): string{
    extract($data);
    extract($values);
    $cartList = cartList($panier);
    
	$errorAlert = '';
	if ($error !== '') {
		$errorAlert = "<div class=\"alert alert-danger mb-3\">$error</div>";
	}
  	return <<<HTML
    <div id="content" class="cart_page checkout_page">
		<!-- cart -->
		<div id="cart" class="cart_section checkout_section">
			<div class="container-fluid" id="checkout">

				<div class="row billing_and_payment_option wow fadeInDown   animated">
					<!-- Billing Address -->
					<div class="col-sm-7 col-lg-6">
						<h3>Paiement sécurisé par carte bancaire</h3>
						$errorAlert
						<form class="eb-form eb-mailform form-checkout" novalidate="novalidate" method="post">
							<div class="row">

								<div class="col-sm-12">
									<div class="form-wrap has-error">
										<input class="form-input form-control" type="text" value="$name"
											name="name" placeholder="Titulaire de la carte">
									</div>
								</div>

								<div class="col-sm-12">
									<div class="form-wrap">
										<input class="form-input form-control"  type="number" value="$numcart"
											name="numcart" placeholder="Numéro de carte">
									</div>
								</div>
                                <div class="col-sm-12">
									<div class="form-wrap">
										<label>Date d'expiration</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-wrap">
                                        <label>Mois </label>
										<select id="card-expiration-month" name="month" class="checkoutDate col-sm-3">
										  <option></option>
										  <option>01</option>
										  <option>02</option>
										  <option>03</option>
										  <option>04</option>
										  <option>05</option>
										  <option>06</option>
										  <option>07</option>
										  <option>08</option>
										  <option>09</option>
										  <option>10</option>
										  <option>11</option>
										  <option>12</option>
										</select>
									  </div>
								</div>

								<div class="col-sm-6">
									<div class="form-wrap">
                                        <label>Année </label>
										<select id="card-expiration-year" name="year" class="checkoutDate col-sm-3">
										  <option></option>
										  <option>2022</option>
										  <option>2023</option>
										  <option>2024</option>
										  <option>2025</option>
										  <option>2026</option>
										  <option>2027</option>
										  <option>2028</option>
										  <option>2029</option>
										  <option>2030</option>
										  <option>2031</option>
										</select>
									  </div>
								</div>

								<div class="col-sm-6">
									<div class="form-wrap has-error">
										<input class="form-input form-control" type="number" value="$crypto"
											name="crypto" pattern="[0-9]+" placeholder="Cryptogramme visuel">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-wrap">
										<p>3 derniers chiffres au dos de votre carte, à droite de la signature</p>
									</div>
								</div>
							</div>
							<button type="submit" class="btn ">Valider</button>
							<input type="hidden" name="ctrl" value="Checkout">
						</form>
					</div>


					<div class="col-sm-5 col-lg-6 wow fadeInDown   animated">
						<h3>Vos articles</h3>
						$cartList
					</div>

				</div>
			</div>
		</div>
	</div>
HTML;
}

function cartList($panier){
    extract($panier);
    $render = '';
    foreach($products as $product){
        $q = $product['quantite'] > 1 ? ' x'.$product['quantite'] : '';
        $render.= '<tr><td>'.$q.' '.$product['nomProduit'].'</td><td>'.$product['prix'].'</td></tr>';
    }
    
    return <<< HTML
    <table> 
        $render
    </table>
    <div>total $prixTotal €</div>
HTML;
}

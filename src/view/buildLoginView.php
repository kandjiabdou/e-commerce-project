<?php

function buildLoginView(string $error): string
{
  $errorAlert = '';
  if ($error !== '') {
    $errorAlert = "<div class=\"alert alert-danger mb-3\">$error</div>";
  }
  return <<<HTML
    <div class="row justify-content-center">
		<div id="content" class="cart_page checkout_page register_page login_page">
			<div id="register" class="cart_section checkout_section register_section">
				<div class="container-fluid" id="checkout">

					<div class="row billing_and_payment_option wow fadeInDown   animated">
						<div class="heading_wrapper wow fadeInDown animated">
							<h2 class="wow fadeInDown animated">Connexion</h2>
							$errorAlert
						</div>
						<div class="login_box">
							<h3>Connectez-vous à votre compte</h3>
							<form class="eb-form eb-mailform form-checkout" action="" method="post">
								<div class="form-wrap">
									<label for="username">nom d'utilisateur:</label>
									<input id="username" class="form-input form-control" type="email" name="username"
										data-constraints="@Email @Required" placeholder="Entrez votre nom d'utilisateur">
								</div>
								<div class="form-wrap">
									<label for="password">Mot de passe:</label>
									<input  id="password" class="form-input form-control" id="checkout-city-1" type="password" name="password"
										data-constraints="@Required" placeholder="Entrez votre mot de passe">
								</div>
								<button type="submit" class="btn ">Se connecter</button>
								<p class="signInclass"> Vous n'avez pas encore de compte? &nbsp;<a href="?ctrl=Signin">Inscrivez-vous</a> </p>
							</form>
							<div class="clear"></div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
HTML;
}

<?php

function buildSigninView($data): string{
  extract($data);
  $errorAlert = '';
  if ($error !== '') {
    $errorAlert = "<div class=\"alert alert-danger mb-3\">$error</div>";
  }
  $firstName = $values['firstName'];
  $lastName = $values['lastName'];
  $username = $values['username'];
  return <<<HTML
    <div id="content" class="cart_page checkout_page register_page login_page">
      <div id="register" class="cart_section checkout_section register_section">
        <div class="container-fluid" id="checkout">
          <div class="row billing_and_payment_option wow fadeInDown   animated">
            <div class="heading_wrapper wow fadeInDown animated">
              <h2 class="wow fadeInDown animated">Inscription</h2>
              $errorAlert
            </div>
            <div class="login_box">
              <h3>Creer votre compte</h3>
              <form class="eb-form eb-mailform form-checkout" action="" method="post">
                <div class="form-wrap">
                  <label for="firstName">prénom:</label>
                  <input type="text" name="firstName" id="firstName" value="$firstName" class="form-input form-control" placeholder="Entrez votre prénom" required>
                </div>
                <div class="form-wrap">
                  <label for="lastName">nom:</label>
                  <input type="text" name="lastName" id="lastName" value="$lastName" class="form-input form-control" placeholder="Entrez votre nom" required>
                </div>
                <div class="form-wrap">
                  <label for="username">nom d'utilisateur:</label>
                  <input id="username" type="email" name="username" class="form-input form-control" value="$username" class="form-control" placeholder="Entrez votre nom d'utilisateur" required>
                </div>
                <div class="form-wrap">
                  <label for="password">Mot de passe:</label>
                  <input id="password" type="password" name="password" class="form-input form-control" placeholder="Entrez votre mot de passe"  required>
                </div>
                <button type="submit" class="btn ">S'inscrire</button>
                <p class="signInclass"> Vous avez déjà un compte? &nbsp;<a href="?ctrl=Login">Connectez-vous</a></p>
              </form>
              <div class="clear"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
HTML;
}

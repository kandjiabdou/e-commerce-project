<?php
require_once 'common/AuthenticationService.php';
class CommonComponents{
  public static function render(string $component, $withNavbar = true, $title = "Home"){
    $head = self::htmlHeadComponent($title);
    $navbar = $withNavbar ? self::navbar() : '';
    $footer = $withNavbar ? self::htmlFooterComponent() : '';
    $footerCopyright = $withNavbar ? self::footerCopyright() : '';
    $scripts = self::scripts();

    echo <<<HTML
      <!doctype html>
      <html lang="fr">
        <head>
          $head
        </head>
        <body>
          <header class="header-area">
            $navbar
          </header>
          
          $component
          
          $footer
          
          $footerCopyright
          $scripts
        </body>
      </html>
    HTML;
  }

  private static function htmlHeadComponent($title): string{
    return <<<HTML
      <title>CATEMONORD | $title</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/e-commerce-project/src/assets/vendor/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="/e-commerce-project/src/assets/css/style.css">
      <link rel="stylesheet" href="/e-commerce-project/src/assets/vendor/owl.carousel/assets/owl.carousel.css">
      <link rel="stylesheet" href="/e-commerce-project/src/assets/vendor/wow/animate.css">
      <link rel="stylesheet" type="text/css" href="/e-commerce-project/src/assets/vendor/slider-js/slideWiz.css">
      <link href="https://fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script type="text/javascript" src="/e-commerce-project/src/assets/js/ajout_panier.js"></script>

    HTML;
  }

  private static function navbar(): string
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    if(!isset($_SESSION['panier']))
      $_SESSION['panier'] = array();
    $nbProductTotal = 0;
    foreach( $_SESSION['panier'] as $qty)
      $nbProductTotal += $qty;
      $connected = '<div class="option-item"><div class="order-btn"><a href="?ctrl=Order" title="Mes commandes"> commandes </a></div></div>';
      $connected .= '<div class="option-item"><div class="logout-btn"><a href="?ctrl=Login&act=logout" title="se déconnecter"><i class="fa fa-sign-out"></i></a></div></div>';
      $notConnected = '<div class="option-item"><div class="login-btn"><a href="?ctrl=Login" title="se connecter"><i class="fa fa-sign-in"> Connexion</i></a></div></div>';
      $navLog = (new AuthenticationService())->isUserConnected() ? $connected : $notConnected ;
    return <<<HTML
      <div class="navbar-area">
        <div class="fashion-nav">
          <div class="container-fluid">
            <div class="row">
              <div class="header_menu_wrapper">
                <nav class="navbar navbar-expand-md navbar-light">
                  <a class="navbar-brand" href="/e-commerce-project/src/index.php"><img src="/e-commerce-project/src/assets/image/logo.png" alt="logo"></a>
                  <div class="collapse navbar-collapse mean-menu" style="display: block;">
                    <ul class="navbar-nav">
                      <li class="nav-item"><a href="/e-commerce-project/src/index.php" class="nav-link active">Home</a></li>
                      <li class="nav-item"><a href="?ctrl=Product&act=allProduct" class="nav-link">Produits</a></li>
                      <li class="nav-item"><a href="?ctrl=AboutUs" class="nav-link">About Us</a></li>
                      <li class="nav-item"><a href="?ctrl=Contact" class="nav-link">Contact</a></li>
                    </ul>
                    <div class="others-option align-items-center">
                      <div class="option-item">
                        <div class="cart-btn">
                          <a href="?ctrl=Panier&act=showCart" title="panier"><i class="fa fa-shopping-cart"></i><span id="nbProductInCart">$nbProductTotal</span></a>
                        </div>
                      </div>
                        $navLog
                    </div>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
		  </div>
HTML;
  }

  private static function htmlFooterComponent(): string
  {
    return <<<HTML
      <footer id="footer" class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="row footer_matter">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="footer_list_wrapper">
                  <h2 class="wow fadeInDown animated">Contacts</h2>
                  <ul class="footer_list">
                    <li><i class="fa fa-map-marker"></i> 93430 Villetaneuse</li>
                    <li><i class="fa fa-phone"></i> Phone. +33 7 00 00 00</li>
                    <li><i class="fa fa-envelope"></i> Email: company@Example.com</li>
                  </ul>
                </div>
                <div class="footer_logo_wrapper">
                  <ul>
                    <li class="wow fadeInDown animated"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="wow fadeInDown animated"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="wow fadeInDown animated"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                    <li class="wow fadeInDown animated"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="footer_list_wrapper">
                  <h2 class="wow fadeInDown animated">Menu</h2>
                  <ul class="footer_list">
                  
                  <li class="wow fadeInDown animated"><a href="?ctrl=Product"><i class="fa fa-angle-right" aria-hidden="true"></i> Produits</a></li>
                  <li class="wow fadeInDown animated"><a href="?ctrl=Panier"><i class="fa fa-angle-right" aria-hidden="true"></i> Panier</a></li>
                  <li class="wow fadeInDown animated"><a href="?ctrl=AboutUs"><i class="fa fa-angle-right" aria-hidden="true"></i> About Us</a></li>
                  <li class="wow fadeInDown animated"><a href="?ctrl=Contact"><i class="fa fa-angle-right" aria-hidden="true"></i> Contact</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="footer_list_wrapper">
                  <h2>Articles</h2>
                  <ul class="footer_list">
                    <li class="wow fadeInDown animated"><a href="?categoryList%5B%5D=1&ctrl=Product"><i class="fa fa-angle-right" aria-hidden="true"></i>Téléphone</a> </li>
                    <li class="wow fadeInDown animated"><a href="?categoryList%5B%5D=2&ctrl=Product"><i class="fa fa-angle-right" aria-hidden="true"></i>Ordinateur</a> </li>
                    <li class="wow fadeInDown animated"><a href="?categoryList%5B%5D=3&ctrl=Product"><i class="fa fa-angle-right" aria-hidden="true"></i>Camera</a> </li>
                    <li class="wow fadeInDown animated"><a href="?categoryList%5B%5D=4&ctrl=Product"><i class="fa fa-angle-right" aria-hidden="true"></i>Montre</a> </li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="download_wrapper">
                  <h2 class="wow fadeInDown animated">Application</h2>
                  <p class="wow fadeInDown animated">Télécharger nos applications</p>
                  <div class="download_btn_wrapper">
                    <a href="https://play.google.com/store/apps/details?id=com.kandjiabdou.jeupions12"><img src="assets/image/App-Store.png" class="img-responsive wow fadeInDown animated" alt="App_Store_img"></a>
                    <a href="https://play.google.com/store/apps/details?id=com.kandjiabdou.jeupions12"><img src="assets/image/Google-Play.png" class="img-responsive wow fadeInDown animated" alt="Google_Play_img"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
    HTML;
  }

  private static function scripts(): string
  {
    return <<<HTML
      <script src="/e-commerce-project/src/assets/vendor/jquery/jquery.min.js"></script>
      <script src="/e-commerce-project/src/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
      <script src="/e-commerce-project/src/assets/vendor/wow/wow.min.js"></script>
      <script type="text/javascript" src="/e-commerce-project/src/assets/vendor/slider-js/slideShow.js"></script>
      <script type="text/javascript" src="/e-commerce-project/src/assets/vendor/slider-js/slideWiz.js"></script>
      <script src="/e-commerce-project/src/assets/js/slider.js"></script>
      <script src="/e-commerce-project/src/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
      <script src="/e-commerce-project/src/assets/js/custom.js"></script>
    HTML;
  }
  private static function footerCopyright(): string
  {
    return <<<HTML
      <div class="footer_copyright">
        <div class="container-fluid">
          <p class="wow fadeInDown animated">© Copyright 2022 by KANDJI-GUEYE-BARRY-BA-SECK. All right Reserved</p>
        </div>
      </div>
    HTML;
  }
}
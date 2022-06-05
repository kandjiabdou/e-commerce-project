<?php

class CommonComponents
{
  public static function render(string $component, $withNavbar = true)
  {
    $head = self::htmlHeadComponent();
    $navbar = $withNavbar ? self::navbar() : '';
    $footer = self::htmlFooterComponent();
    $footerCopyright = self::footerCopyright();
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
          <footer id="footer" class="footer">
            $footer
          </footer>
          $footerCopyright
          $scripts
        </body>
      </html>
    HTML;
  }

  private static function htmlHeadComponent(): string
  {
    return <<<HTML
      <title>Fashion Shop | Home</title>
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
    HTML;
  }

  private static function navbar(): string
  {
    return <<<HTML
      <div class="navbar-area">
        <div class="fashion-nav">
          <div class="container-fluid">
            <div class="row">
              <div class="header_menu_wrapper">
                <nav class="navbar navbar-expand-md navbar-light">
                  <a class="navbar-brand" href="/e-commerce-project/src/index.html"><img src="/e-commerce-project/src/assets/image/logo/logo.png" alt="logo"></a>
                  <div class="collapse navbar-collapse mean-menu" style="display: block;">
                    <ul class="navbar-nav">
                      <li class="nav-item"><a href="/e-commerce-project/src/index.php" class="nav-link active">Home</a></li>
                      <li class="nav-item"><a href="?controller=product&action=allproduct" class="nav-link">Produits</a></li>
                      <li class="nav-item"><a href="" class="nav-link">About Us</a></li>
                      <li class="nav-item"><a href="" class="nav-link">Contact</a></li>
                    </ul>
                    <div class="others-option align-items-center">
                      <div class="option-item">
                        <div class="cart-btn">
                          <a href="cart.html"><i class="fa fa-shopping-cart"></i><span>0</span></a>
                        </div>
                      </div>
                      <div class="option-item">
                        <div class="login-btn">
                          <a href=""><i class="fa fa-sign-in"></i></a>
                        </div>
                      </div>
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
                <li class="wow fadeInDown animated"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> About Us</a></li>
                <li class="wow fadeInDown animated"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> Products List</a></li>
                <li class="wow fadeInDown animated"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> Panier</a></li>
                <li class="wow fadeInDown animated"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i> Contact</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="footer_list_wrapper">
                <h2>Articles</h2>
                <ul class="footer_list">
                  <li class="wow fadeInDown animated"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>telephon</a> </li>
                  <li class="wow fadeInDown animated"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>ordinateur</a> </li>
                  <li class="wow fadeInDown animated"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>camera</a> </li>
                  <li class="wow fadeInDown animated"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>objet connecté</a> </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="download_wrapper">
                <h2 class="wow fadeInDown animated">Application</h2>
                <p class="wow fadeInDown animated">Télécharger nos applications</p>
                <div class="download_btn_wrapper">
                  <a href="#"><img src="assets/image/App-Store.png" class="img-responsive wow fadeInDown animated" alt="App_Store_img"></a>
                  <a href="#"><img src="assets/image/Google-Play.png" class="img-responsive wow fadeInDown animated" alt="Google_Play_img"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
          <p class="wow fadeInDown animated">© Copyright 2022 by Barguekan. All right Reserved - Design By Barry, Gueye, Kandji</p>
        </div>
      </div>
    HTML;
  }
}

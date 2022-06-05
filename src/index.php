<?php

require_once 'common/CommonComponents.php';
require_once 'controller/HomeController.php';
require_once 'database/DatabaseHomeRepository.php';

$homeController = new HomeController(new DatabaseHomeRepository());
$homeHtml = $homeController->viewAction();
CommonComponents::render($homeHtml);

/*
<?php

require_once 'common/CommonComponents.php';
require_once 'controller/ProductListController.php';
require_once 'database/DatabaseProductListRepository.php';

$productListController = new ProductListController(new DatabaseProductListRepository());
$productListHtml = $productListController->viewAction();
CommonComponents::render($productListHtml);

 */
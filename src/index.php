<?php
/*require_once 'common/CommonComponents.php';
require_once 'common/AuthenticationService.php';
require_once 'controller/CounterController.php';
require_once 'database/DatabaseCompteurRepository.php';

$counterController = new CounterController(new AuthenticationService(), new DatabaseCompteurRepository());
$counterHtml = $counterController->viewAction();
CommonComponents::render($counterHtml);
*/

require_once 'common/CommonComponents.php';
require_once 'controller/ProductListController.php';
require_once 'database/DatabaseProductListRepository.php';

$productListController = new ProductListController(new DatabaseProductListRepository());
$productListHtml = $productListController->viewAction();
CommonComponents::render($productListHtml);



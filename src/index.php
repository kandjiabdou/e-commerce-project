<?php

require_once 'common/CommonComponents.php';
require_once 'controller/ProductListController.php';
require_once 'database/DatabaseProductListRepository.php';

$productListController = new ProductListController(new DatabaseProductListRepository());
$productListHtml = $productListController->viewAction();
CommonComponents::render($productListHtml);

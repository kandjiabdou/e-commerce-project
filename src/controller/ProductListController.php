<?php
require_once __DIR__ . '/../view/buildProductListView.php';

class ProductListController{
  private $productListRepository;

  public function __construct(ProductListRepository $productListRepository){
    $this->productListRepository = $productListRepository;
  }

  public function viewAction(): string {
    return buildProductListView($this->productListRepository->getAllProduit());
  }
}
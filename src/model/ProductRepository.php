<?php
interface ProductRepository {
  public function getAllProduct();
  public function getProduitDetails($id);
  public function getAllProductWithLimit($tri, $categoryFilter, $minPrice, $maxPrice, $offset, $nbResultatParPage);
  public function getCategorys();
  public function getNbTotalProduct($categoryFilter, $minPrice, $maxPrice);
}

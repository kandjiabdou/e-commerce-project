<?php
interface ProductRepository {
  public function getAllProduct();
  public function getProduitDetails($id);
  public function getAllProductWithLimit($offset, $nbResultatParPage);
  public function getNbTotalProduct();
}

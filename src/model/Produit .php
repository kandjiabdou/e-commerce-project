<?php

class Produit {
  private $produitID;
  private $nomProduit;
  private $prix;
  private $description;
  private $categorie

  public function __construct($produitID, $nomProduit,$prix,$description, $categorie){
    $this->produitID = $produitID;
    $this->nomProduit = $nomProduit;
    $this->prix = $prix;
    $this->description= $description;
    $this->categorie= $categorie;
  }
}

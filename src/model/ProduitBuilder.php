<?php

class ProduitBuilder {
  private int $produitID = '';
  private string $nomProduit= '';
  private float $prix='';
  private string $description='';
  private int $categorie='';

  public function __construct($produitID, $nomProduit,$prix,$description, $categorie){
    $this->produitID = $produitID;
    $this->nomProduit = $nomProduit;
    $this->prix = $prix;
    $this->description= $description;
    $this->categorie= $categorie;
  }

  public function withProduiId(int $id)
  {
      $this->produitID=$id;
      return $this;
  }
  public function withNomProduit(string $nom)
  {
      $this->nomProduit=$nom;
      return $this;
  }
  public function withPrix(int $prix)
  {
      $this->prix=$prix;
      return $this;
  }
  public function withDescription(string $desc)
  {
      $this->description=$desc;
      return $this;
  }
  public function withCategorie(int $categorie)
  {
      $this->categorie=$categorie;
      return $this;
  }
  public function build():Produit 
  {
    return new Produit($this->produitID,$this->nomProduit, $this->prix,$this->description, $this->categorie );
  }
}

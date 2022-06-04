<?php

function buildProductListView($productList): string
{
  $render = '';
  if (empty($productList)) {
    $render = '<strong>Aucun produit dans cette sous catégorie</strong>';
  } else {
      foreach ($productList as $product) {
        $render .= '<div class="produit_list">
        <div class="image_produit">
            <a href="">
                <img class="display" src='.$product['cheminimage'].' alt="image produit"/>
            </a>
        </div>
        <div class="content_produit">
            <a href="">
                <span><strong>'.$product['nomProduit'].'</strong></span></a>
            <hr>
            <span class="description">'.$product['description'].'</span>
        </div>
    </div>';
      }
  }

  return <<<HTML
    <div>
      $render
    </div>
HTML;
}

/*$render .= '<div class="produit_list">
        <div class="image_produit">
            <a href="?action=productCategorie&id= '.$product['produitID'].'">
                <img class="display" src='.$product['cheminimage'].' alt="image produit"/>
            </a>
        </div>
        <div class="content_produit">
            <a href="?action=productCategorie&id='.$product['produitID'].'">
                <span><strong>'.$product['nomProduit'].'</strong></span></a>
            <hr>
            <span class="description">'.$product['description'].'</span>
        </div>
    </div>';*/

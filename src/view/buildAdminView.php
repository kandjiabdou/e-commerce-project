<?php

function buildAdminView($data): string{
  extract($data);
  $messageAlert = '';
  if ($message !== '') {
    $messageAlert = "<div class=\"alert alert-danger mb-3\">$message</div>";
  }
  $name = $values['name'] !== '' ? $values['name'] : '';
  $description = $values['description'] !== '' ? $values['description'] : '';
  $navHTML = navigation();
  $categoryHtml = categories($categories);
  $trie_par_defautHtml = trie_par_defaut($sort);
  
  return <<<HTML
    $navHTML
    <div id="content" class="products_page">
      <div id="products" class="products_section">
        <div class="container-fluid">
          <div class="row">
            <h2 class="wow fadeInDown animated">Page d'Administration du site</h2>
            $messageAlert
            <div id="filterProduct" class="col-sm-9 cd-filter">
              <!--Ajouter un article-->
              <div class="row wow fadeInDown   animated">
                <div class="heading_wrapper wow fadeInDown animated">
                  <h3>Ajouter un article</h3>
                </div>

                <div class="login_box">
                  <form class="eb-form eb-mailform" action="" method="post">
                    <div class="form-wrap">
                      <label for="name" class="col-sm-3">Nom: </label>
                      <input type="text" name="name" id="name" value="$name" class="form-input form-control" placeholder="Entrez le nom de l'article" required>
                    </div>
                    <div class="form-wrap">
                      <label for="quantite" class="col-sm-3" >Quantité: </label>
                      <input type="number" name="quantite" id="quantite" value="" min="0" class="form-input form-control" placeholder="Entrez la quantité du produit" required>
                    </div>
                    <div class="form-wrap">
                      <label for="prix" class="col-sm-3" >Prix: </label>
                      <input id="prix" type="number" name="prix" class="form-input form-control" min="0" value="" placeholder="Entrez le prix du produit" required>
                    </div>
                    <div class="form-wrap">
                      <label for="description" class="col-sm-3" >Catégorie: </label>
                      $categoryHtml
                    </div>
                    <div class="">
                      <label for="description" class="col-sm-3" >Description: </label>
                      <input id="description" type="text" name="description" value="$description" class="form-input form-control" placeholder="Donner la description du produit"  required>
                    </div>
                    <input type="hidden" name="act" value="add_product">
                    <button type="submit" class="btn">Ajouter l'article</button>
                  </form>
                  <div class="clear"></div>
                </div>
              </div>
            </div>

            <div id="filterProduct" class="col-sm-3">
              <div class="filter_box">
                <!--Trie par défaut-->
                <div class="heading_wrapper wow fadeInDown animated">
                  <h3>Définir le trie par défaut</h3>
                  $trie_par_defautHtml
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  </div>
HTML;
}
function navigation(){
  return <<<HTML
  <div class="navbar-area">
    <div class="fashion-nav">
      <div class="container-fluid">
        <div class="row">
          <div class="header_menu_wrapper">
            <nav class="navbar navbar-expand-md navbar-light">
              <a class="navbar-brand" href="#"><img src="/e-commerce-project/src/assets/image/logo.png" alt="logo"></a>
              <div class="collapse navbar-collapse mean-menu" style="display: block;">
                <div class="others-option align-items-center">
                  <div class="option-item">
                    <div class="cart-btn"><p class="wow fadeInDown animated">Vous êtes connecté en tant qu'administrateur</p></div>
                  </div>
                  <div class="option-item">
                    <div class="login-btn"> <a href="?ctrl=Login&act=logout" title="se déconnecter"><i class="fa fa-sign-out"> Deconnexion</i></a></div>
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

function categories($categorys){
  $htmlCategory = '<option value="" > Selectionner la catégorie </option>';
  foreach($categorys as $categorie){
    $htmlCategory .='<option value="'.$categorie['categorieID'].'" >'.$categorie['nomCategorie'].'</option>';
  }
  return <<<HTML
    <select name="categorie" class="form-control" required>
      $htmlCategory
    </select>
HTML;
}

function trie_par_defaut($sort){
  $optionList = '';
  $listSort = ["Nom (A - Z)", "Nom (Z - A)", "Prix - croissant", "Prix - décroissant"];
  for($i=0; $i<4; $i++){
    $optionList .='<option value="'.$i.'" '.($i == $sort ? 'selected="selected"' : '').' >'.$listSort[$i].'</option>';
  }
  return <<<HTML
  <div class="sort-by-wrapper">
    <label class="input-group-addon" for="input-sort">Trier par défaut</label>
    <div class="select-wrapper">
      <form action="" method="post">
        <select name="defaultSort" class="form-control" onchange="this.form.submit()">
          $optionList
        </select>
        <input type="hidden" name="act" value="setSort">
      </form>
    </div>
  </div>
HTML;
}

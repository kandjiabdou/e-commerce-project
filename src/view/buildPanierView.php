<?php
function buildPanierView($data): string{
    $htlmPanier = "<h2>VOTRE PANIER EST TRISTEMENT VIDE</h2>";
    $htlmPanier.='<a href="?ctrl=Product"><button class="detail-button btn btn-medium btn-primary">Trouver des idées</button></a>';
    if(sizeof($data) !== 0)
        $htlmPanier = buildPanierListHtml($data);
    return <<<HTML
    <!-- breadcrumb -->
    <section class="main_breadcrumb">
        <div class="container-fluid">
            <div class="row">
                <div class="breadcrumb-content">
                    <h2>Panier</h2>
                    <ul>
                        <li><a href="?">Home</a></li>
                        <li><a href="#">Panier</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div id="content" class="cart_page">
        <!-- cart -->
        <div id="cart" class="cart_section">
            <div class="container-fluid">
                $htlmPanier
            </div>
        </div>
    </div>

HTML;
}

function buildPanierListHtml($data){
    extract($data);
    $render = "";
    foreach($products as $p){
        $render.='<tr id="product'.$p['produitID'].'">
            <td>
                <a class="table-cart-figure" href="?ctrl=Product&act=SingleProduit&produitID='.$p['produitID'].'">
                <img src="assets/image/'.$p['cheminimage'].'" alt="" width="146" height="132"></a>
                <a class="table-cart-link" href="?ctrl=Product&act=SingleProduit&produitID='.$p['produitID'].'">'.$p['nomProduit'].'</a>
            </td>
            <td id="productPrice'.$p['produitID'].'">'.$p['prix'].'</td>
            <td>
                <div class="custom pull-left">
                    <form class="cart_quantity">
                        <div class="form_display">
                            <button value="-1" class="btn_crement_product elem_qty items-count" type="button">
                                <i class="fa fa-minus">&nbsp;</i>
                            </button>
                            <input name="quantity" type="number" min="1" class="elem_qty input-text qty input_crease" title="Qty" value="'.$p['quantite'].'" maxlength="12" id="qty" readonly>
                            <input type="hidden" name="product_id" value="'.$p['produitID'].'" class="elem_qty">
                            <button value="1" class="btn_crement_product elem_qty items-count" type="button">
                                <i class="fa fa-plus">&nbsp;</i>
                            </button>
                        <div>
                    </form>
                </div>
            </td>
            <td id="productTotal'.$p['produitID'].'" class="product_total">'.$p['prixTotal'].'</td>
            <td class="sansBordure">
                <button value="'.$p['produitID'].'" type="button" class="btn_supprime_produit btn wow fadeInDown animated"
                    title="Supprimer ce produit du panier"><span><i class="fa fa-trash"></i> Supprimer </span></button>
            </td>
        </tr>';
    }
    return <<<HTML
    <div id="listPoduitPanier" class="row">
        <div class="table-custom-responsive wow fadeInDown animated">
            
            <table class="table-custom table-cart table-responsive">
                <thead>
                    <tr>
                        <th>Nom du Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th class="sansBordure"></th>
                    </tr>
                </thead>
                <tbody>

                    $render

                </tbody>
            </table>
        </div>

        <div class="group-xl group-justify  wow fadeInDown animated">
            <div>
                <div class="group-xl group-middle">
                    <div>
                        <div class="group-md group-middle">
                            <div class="heading-5 font-weight-medium text-gray-500">Total</div>
                            <div class="heading-3 font-weight-normal"> <span id="cartTotal">$prixTotal</span> € </div>
                        </div>
                    </div><a class="btn" href="?ctrl=Checkout">Valider et payer</a>
                </div>
            </div>
        </div>
    </div
HTML;
}
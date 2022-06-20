<?php
function buildOrderView($data): string{
    $htlmOrder = "<h2>Vous n'avez fait aucune commande !</h2>";
    $htlmOrder.='<a href="?ctrl=Product"><button class="detail-button btn btn-medium btn-primary">Commander maintenant</button></a>';
    if(sizeof($data) !== 0)
        $htlmOrder = buildOrderListHtml($data);
    return <<<HTML
    <section class="main_breadcrumb">
        <div class="container-fluid">
            <div class="row">
                <div class="breadcrumb-content">
                    <h2>Commandes</h2>
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
                $htlmOrder
            </div>
        </div>
    </div>

HTML;
}

function buildOrderListHtml($oders){
    $render = "";
    foreach($oders as $commande){
        $render.='<tr">
            <td>'.$commande['HeureAchat'].'</td>
            <td>'.$commande['nbProduit'].'</td>
            <td>'.$commande['prixTotal'].'</td>
        </tr>';
    }
    return <<<HTML
    <div id="listPoduitPanier" class="row">
        <div class="table-custom-responsive wow fadeInDown animated">
            
            <table class="table-custom table-cart table-responsive">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>nombre d'article</th>
                        <th>Prix totale de la commande</th>
                    </tr>
                </thead>
                <tbody>
                    $render
                </tbody>
            </table>
        </div>
    </div>
HTML;
}

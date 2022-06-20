(function ($) {
    $(document).on('click', '.btn_ajout_panier', function(e){
        e.preventDefault();
        var $thisbutton = $(this);
        id = $thisbutton.val();
        var data = {
            action: 'add_product',
            productID: id,
        };

        $.ajax({
            type: 'post',
            url: "Panier.php",
            data: data,
            success: function (response) {
                $("#nbProductInCart").html(response);
            },
        });

        return false;
    });

    $(document).on('click', '.btn_supprime_produit', function(e){
        e.preventDefault();
        var $thisbutton = $(this);
        id = $thisbutton.val();

        var data = {
            action: 'delete_product',
            productID: id,
        };

        $.ajax({
            type: 'post',
            url: "Panier.php",
            data: data,
            success: function (response) {
                $("#nbProductInCart").html(response);
                if(response == 0)
                    $("#listPoduitPanier").html("<p>Aucun produit sur votre panier !<p>");
                else{
                    var minusPrice = parseInt($("#productTotal"+id).html());
                    var odlT = parseInt($("#cartTotal").html());
                    $("#cartTotal").html(odlT-minusPrice);
                    $("#product"+id).remove();
                }
                    
            },
        });

        return false;
    });

    $(document).on('click', '.btn_crement_product', function(e){
        e.preventDefault();
        var $thisbutton = $(this),
        $form = $thisbutton.closest('form.cart_quantity'),
        $input = $form.find('input[name=quantity]');
        var qty = Number($input.val());
        var pid = Number($form.find('input[name=product_id]').val());
        var i = Number($thisbutton.val());
        if(qty==1 && i==-1) return false;
        if(qty<0){$input.val(1); return false;}
        qty += i;
        $input.val(qty);
        var data = {
            action: 'crement_product_qty',
            productID: pid,
            qty: qty
        };

        $.ajax({
            type: 'post',
            url: "Panier.php",
            data: data,
            success: function (response) {
                $("#nbProductInCart").html(response);
                var productPrice = parseInt($("#productPrice"+pid).html());
                $("#productTotal"+pid).html(productPrice*qty);
                var t = 0;
                $('.product_total').each(function(){
                    t += parseInt($(this).html());
                });
                $("#cartTotal").html(t);
            },
        });

        return false;
    });
})(jQuery);
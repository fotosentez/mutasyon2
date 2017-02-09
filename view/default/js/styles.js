//Get url 
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;
    
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

/*
------------------------------CART-----------------------------
*/
/*For add to cart 
 * For sell use addToCartButton('bla bla', '') 
 * for buy use addToCartButton('', 'bla bla')
*/
function addToCartButton(sell = false, buy = false){
    $.ajax({
        type:'POST',
        url: 'controller/cart/cart.php',
        data : { sellProduct : sell, buyProduct: buy },
        success:function(t){
            new PNotify({
                title: false,
                text: t,
                type: 'info',
            });
        }
    });
}


//Remove item from cart
function removeFromCart(removedID, key){
    if(key == "buy"){
        $.ajax({
            type:'POST',
            url: 'controller/cart/cart.php',
            data : { 'removedID':removedID, 'key':key},
            success:function(t){
                new PNotify({
                    title: false,
                    text: t,
                    type: 'info',
                });
            }
        });
    }
}

//For sum price and find total cart
/*
* Here amount is amount of product,
* subPrice is price for each product  
* forSum is value for sum all input for find total
*/
function changeProductTotal(e){
    var subTotal = 0;
    var amount = $(".amount" + e).val();
    var price = $("#subPrice" + e).val();
    subTotal = amount*price;
    $(".forSum" + e).val(subTotal.toFixed(2));
    writeTotal();
}
function writeTotal(){
    var totalPoints = 0;
    $(".forSum").each(function(i,n){
        totalPoints = parseFloat($(n).val(),10) + totalPoints;
        $(".cartTotal").text(totalPoints.toFixed(2));
        $(".cartTotali").val(totalPoints.toFixed(2));
        $(".payprice").val(totalPoints.toFixed(2));
    });
}


/*
--------------------------------AUTOCOMPLETE----------------------------
*/
$( ".autocomplete" ).autocomplete({
    source: function(request, response) {
        var sent = getUrlParameter('url');
        $.getJSON(
            "model/search.php",
            { term:request.term, extraParams: sent }, 
                  response
        );
    },
    minLength: 2,
    select: function(event, ui){
        if(ui.item.sId){
            $("#sellerId").val(ui.item.sId);
        }
        if(ui.item.SKU){
            $("#productSKU").val(ui.item.SKU);
        }
        if(ui.item.buy){
            $(".autocomplete").attr('onChange', 'addToCartButton("", '+ ui.item.buy +')');
        }
    }
});
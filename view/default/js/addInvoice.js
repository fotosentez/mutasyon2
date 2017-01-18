$('input.whichInvoice').on("click", function() {
    if($('#typeP').is(':checked')) {
        $("#addProductForm").removeClass("displayNone");
        $("#addServiceForm").addClass("displayNone");
    }
    if($('#typeS').is(':checked')) {
        $("#addServiceForm").removeClass("displayNone");
        $("#addProductForm").addClass("displayNone");
    }
});


//Add invoice
var options = {
    source: "controller/invoice/addInvoice.php",
    minLength: 2,
    select: function(event, ui) { 
        $("#productSKU").val(ui.item.SKU);
        $("#productPrice").val(ui.item.price);
    }
};
var selector = '#addToCart';
$(document).on('keydown.autocomplete', selector, function() {
    $(this).autocomplete(options);
});

$(document).keypress(function(e) {
    if(e.which == 13) {
        addToCart();
    }
});

var i = 0;
var toplamfiyat = 0;
function addToCart() {
    var productName = $("#addToCart").val();
    var productSKU = $("#productSKU").val();
    var productPrice = $("#productPrice").val();
    
    if (productName != "" && productPrice != "" && parseInt(productPrice))
    {
        i++;
        
        var eklenecek = '<div id="sira'+i+'" class="siralar col-xs-12"><input type="text" value="'+ productSKU +'" class="col-xs-2" name="productname[]" /><input type="text" value="'+ productName +'" class="col-sm-6 col-xs-5" name="productname[]" /><input type="number" id="adet'+i+'" value="1" class="col-sm-1 col-xs-2" name="amount[]" /><input type="text" id="fiyat'+i+'" value="'+ productPrice +'" class="col-xs-2" name="price[]" /><li class="col-xs-1 colorRed"><a class="sil btn btn-link"  onClick="delBasketPr('+i+')"><i class="fa fa-times"></i></a></li></div>';
        document.getElementById("sepet").innerHTML += eklenecek;
        
        
        $("#addToCart").val("").focus();
        $(".#productPrice").val("");
    }
};
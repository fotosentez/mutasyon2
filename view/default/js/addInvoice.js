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
$( ".autocomplete" ).autocomplete({
    source: function(request, response) {
        $.getJSON(
            "model/search.php",
            { term:request.term, extraParams: $(this.element).prop("id") }, 
                  response
        );
    },
    minLength: 2,
    select: function(event, ui){
        if(ui.item.cId){
            $("#customerId").val(ui.item.cId);
        }
        if(ui.item.SKU){
            $("#productSKU").val(ui.item.SKU);
            $("#productPrice").val(ui.item.price);
        }
    }
});

$(document).keypress(function(e) {
    if(e.which == 13) {
        $(':input[type="submit"]').prop('disabled', true);
        addToCart();
    }
    if (e.ctrlKey && e.keyCode == 13) {
        $(':input[type="submit"]').prop('disabled', false);
    }
});


//Basket
var i = 0;
var totalPrice = 0;
function addToCart() {
    var productName = $("#addToCart").val();
    var productSKU = $("#productSKU").val();
    var productPrice = $("#productPrice").val();
    
    if (productName != "" && productPrice != "" && parseInt(productPrice))
    {
        i++;
        
        var writeVal = $("#addToCart").val();
        $('.prname').each(function(){
            var value = $(this).val();
            var amount = $(this).parent().find('.prAmount').val();
            if(writeVal == value){
                $("#addToCart").val("").focus();
                exit();
            }
        });
        
        totalPrice += 1*productPrice;
        var add = '<div id="row'+i+'" class="siralar col-xs-12"><input type="text" value="'+ productSKU +'" class="col-xs-2" name="SKU[]" /><input type="text" value="'+ productName +'" class="prname col-sm-6 col-xs-5" name="productname[]" /><input onChange="changeAmount('+i+')" id="amount'+i+'" type="number" value="1" class="prAmount col-sm-1 col-xs-2" name="amount[]" /><input id="price'+i+'" type="number" value="'+ productPrice +'" class="prPrice col-xs-2" name="price[]" /><input id="priceh'+i+'" type="hidden" value="'+ productPrice +'" /><li class="col-xs-1 colorRed"><a class="sil btn btn-link"  onClick="delBasketPr('+i+')"><i class="fa fa-times"></i></a></li></div>';
        document.getElementById("cart").innerHTML += add;
        writeTotal();
        
        
        $("#addToCart").val("").focus();
        $(".#productPrice").val("");
    }
};

//Delete product from basket
function delBasketPr(e) {
    var amount = $("#amount"+e).val();
    var price = $("#price"+e).val();
    var lastTotal = $("#total span").text();
    var delPrice = amount*price;
    var nowTotal = lastTotal-delPrice;
    $("#total span").html(nowTotal);
    $("#totalInput").val(nowTotal);
    $("#row"+e).remove();
    i--;
    return false;
}

function changeAmount(e){
    var price = $("#priceh"+e).val();
    var amount = $("#amount"+e).val();
    $("#price"+e).val(price*amount);
    writeTotal();
}
function writeTotal(){
    var totalPoints = 0;
    $('.siralar').find('input.prPrice').each(function(i,n){
        totalPoints = parseInt($(n).val(),10) + totalPoints;
        $("#total span").html(totalPoints);
        $("#totalInput").val(totalPoints);
    });
}
function clickToAddCart(e){
    var productName = $("#"+e).find(".listProductName").text();
    var productSKU = $("#"+e).find('.SKU').text();
    var productPrice = $("#"+e).find('.listPrice').text();
    
    $("#addToCart").val(productName);
    $("#productSKU").val(productSKU);
    $("#productPrice").val(productPrice);
    addToCart();
}
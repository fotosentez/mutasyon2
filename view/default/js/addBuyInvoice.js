$('.notvirtual').click(function(){
    var inp = $('.buybank').find('.notpay');
    $(inp).prop('disabled', function(i, val){
        return !val;
    });
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
        if(ui.item.sId){
            $("#sellerId").val(ui.item.sId);
        }
        if(ui.item.SKU){
            $("#productSKU").val(ui.item.SKU);
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
    var productName = $("#products").val();
    var productSKU = $("#productSKU").val();
    
    if (productName != "")
    {
        i++;
        
        var writeVal = $("#products").val();
        $('.prname').each(function(){
            var value = $(this).val();
            var amount = $(this).parent().find('.prAmount').val();
            if(writeVal == value){
                $("#products").val("").focus();
                exit();
            }
        });
        
        var add = '<div id="row'+i+'" class="siralar col-xs-12"><input type="text" value="'+ productSKU +'" class="col-xs-2" name="SKU[]" id="SKU'+i+'" /><input type="text" value="'+ productName +'" class="prname col-xs-6" name="productname[]" id="productname'+i+'" /><input onChange="changeAmount('+i+')" id="amount'+i+'" type="number" value="1" class="prAmount col-xs-1" name="amount[]" /><input id="price'+i+'" type="number" onChange="changeAmount('+i+')"  class="prPrice col-xs-1" name="price[]" /><input type="number" class="prPrice col-xs-1" name="salePrice[]" id="salePrice'+i+'" /><input id="priceh'+i+'" class="priceh" type="hidden" /><li class="col-xs-1 colorRed"><a class="sil btn btn-link"  onClick="delBasketPr('+i+')"><i class="fa fa-times"></i></a></li></div>';
        document.getElementById("cart").innerHTML += add;        
        
        $("#products").val("").focus();
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
    var price = $("#price"+e).val();
    var amount = $("#amount"+e).val();
    $("#priceh"+e).val(price*amount);
    writeTotal();
}
function writeTotal(){
    var totalPoints = 0;
    $(".priceh").each(function(i,n){
        totalPoints = parseInt($(n).val(),10) + totalPoints;
        $("#total span").html(totalPoints);
        $("#totalInput").val(totalPoints);
        $(".payprice").val(totalPoints);
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
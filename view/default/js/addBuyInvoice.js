$('.virtual').click(function(){
    var inp = $('.buybank').find('.notpay');
    $(inp).prop('disabled', function(i, val){
        return !val;
    });
});

$('#ready').click(function(){
    var inp = $(':input[type="submit"]');
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
        addToCart();
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
                return false;
            }
        });
        
        var add = 
        '<div id="row'+i+'" class="siralar col-xs-12">'+
            '<input autocomplete="off" type="text" value="'+ productSKU +'" class="hidden-xs col-sm-2" name="SKU[]" id="SKU'+i+'" />'+
            '<input autocomplete="off" type="text" value="'+ productName +'" class="prname col-xs-8 col-sm-6 productname'+i+'" name="productname[]" />'+
            '<input autocomplete="off" onChange="changeAmount('+i+')" type="number" value="1" class="amount'+i+' prAmount col-xs-1" name="amount[]" />'+
            '<input autocomplete="off" type="number" onChange="changeAmount('+i+')" class="price'+i+' prPrice col-xs-1" name="price[]" />'+
            '<input autocomplete="off" id="priceh'+i+'" class="priceh" type="hidden" />'+
            '<span class="subTotal'+i+' col-xs-1 subTotal">{{$currency}} 0</span>'+
            '<li class="col-xs-1 removeButton">'+
                '<a class="btn btn-danger btn-xs"  onClick="delBasketPr('+i+')">'+
                    '<i class="fa fa-times"></i>'+
                '</a>'+
            '</li>'+
        '</div>';
        document.getElementById("cart").innerHTML += add;        
        
        $("#products").val("").focus();
    }
};

//Delete product from basket
function delBasketPr(e) {
    var amount = $(".amount"+e).val();
    var price = $(".price"+e).val();
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
    var price = $(".price"+e).val();
    var amount = $(".amount"+e).val();
    $(".subTotal"+e).text(price*amount);
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
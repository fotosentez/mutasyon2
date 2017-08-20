/*----------------------------------------
 * Change scrollbar view
 */
//Burayı sonra yap
//----------------------------------------

/*-------------------------VIRTUAL-----------------------------
 * virtual is class of checkbox
 * for disable use notpay class
 */
$('.virtual').click(function(){
    var inp = $('.notpay');
    $(inp).prop('disabled', function(i, val){
        return !val;
    });
});
//---------------------------------------------------------------


/*
 * ------------------------------CART-----------------------------
/*For add to cart 
 * For sell use addToCartButton('bla bla', '') 
 * for buy use addToCartButton('', 'bla bla')
 */
function addToCartButton(sell = false, buy = false){
    $.ajax({
        type:'POST',
        url: 'view/default/php/php.php',
        data : { sellProduct : sell, buyProduct: buy },
        success:function(t){
            new PNotify({
                title: false,
                text: t,
                type: 'info',
            });
        }
    });
    changeProductTotal();
}
//-----------------------------------------------------------------

/*-----------------REMOVE FROM CART--------------------------------
 */
function removeFromCart(removedID, key){
    if(key == "buy"){//Remove item from buy cart
        $.ajax({
            type:'POST',
            url: 'view/default/php/php.php',
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
    else if(key == 'sell'){//remove item from sell cart
        $.ajax({
            type:'POST',
            url: 'view/default/php/php.php',
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
//-----------------------------------------------------------------------------------



/*----------------------------WRITE INVOICE TOTAL--------------------------------------
 * Amount class is amount,
 * Price class is eachPrice,
 * Sub total of each product class is eachSubTotal,
 * Discount rate class is discountRate,
 * Discount class is discount,
 * Sub total of invoice class is subTotal,
 * Total of invoice (include discount too) class is total
 */
writeInvoiceInfs();
function writeInvoiceInfs(e){
    var amount = $('.amount' + e).val(); //Get product amount
    
    var eachPrice = $('.eachPrice' + e).text(); //Get product price (If eachPrice is not input)
    var eachPrice = $('.eachPrice' + e).val(); //Get product price
    
    var eachSubTotal = amount*eachPrice; //Calculate amount*price
    $('.eachSubTotal' + e).text(eachSubTotal.toFixed(2));//Write sub total each product
    
    var subTotal = 0; //sub total
    $(".eachSubTotal").each(function(i,n){
	subTotal = parseFloat($(n).text(),10) + subTotal;
	$(".subTotal").text(subTotal.toFixed(2));//write sub total (not include discount)
	$(".subTotal").val(subTotal.toFixed(2));//write sub total (not include discount)
    });
    //writeDiscount();
    writeTotal();
}
function writeDiscount(){
    var discountType = $('.discountType').val();
    var discountRate = $('.discountRate').val();
    var subTotal = $('.subTotal').text();
    var discountValue = $('.discount').text();
    alert(discountValue);
    if(!discountValue){
	if(discountType == 'percent'){var discount = subTotal*discountRate/100;}else{var discount = discountRate - 0;}
	$('.discount').text(discount.toFixed(2));
    }
    
    
}
function writeTotal(){
    var subTotal = $('.subTotal').text();
    var discount = $('.discount').text();
    var payment = $('.payment').text();
    $(".total").text((subTotal - discount).toFixed(2));
    $(".total").val((subTotal - discount).toFixed(2));
    $(".remain").text((subTotal - discount -payment).toFixed(2));
    $(".remain").val((subTotal - discount -payment).toFixed(2));
}
//---------------------------------------------------------------------------------------------------------



/*-----------------GET DISCOUNT OF CUSTOMER----------------------------------------------------------------
 * If avilable Get customer discount from customer group
 */
function getDiscount(){
    var customerId = $('.customer').val();
    $.ajax({
        type:'POST',
        url: 'view/default/php/php.php',
        data : { 'customerId': customerId},
        success:function(t){
            $('.discountRate').val(t);
	    writeInvoiceInfs();
        }
    });
}

/*---------------------------POST WITHOUT RELOAD PAGE------------------------------------------------------- 
 * Send forms with ajax no reload
 */
$(document).ready(function() {
    $(".noload").each(function(index) {   
        $(".noload").eq(index).submit(function(event){
            event.preventDefault();
            $.post($(".noload").eq(index).attr("action"), $(".noload").eq(index).serialize(), function(message){
                $(".inf").removeClass("displayBlock");
                new PNotify({
                    title: false,
                    text: message,
                    type: 'info',
                });
            });
        });
    });
});
//Send forms which used tinyMCE with ajax no reload
$(document).ready(function() {
    $(".tinyMCE").each(function(index) {   
        $(".tinyMCE").eq(index).submit(function(event){
            tinyMCE.triggerSave();
            event.preventDefault();
            $.post($(".tinyMCE").eq(index).attr("action"), $(".tinyMCE").eq(index).serialize(), function(message){
                $(".inf").removeClass("displayBlock");
                new PNotify({
                    title: false,
                    text: message,
                    type: 'info',
                });
            });
        });
    });
});
//-----------------------------------------------------------------------------------------------------------------



/*-------------------------CHANGE VIEW OR ORDER PRODUCTS---------------------------------------
 * 
 */
function changeView(value){
    if(value == 'category'){
        value = $('[name=category]').val();
    }
    
    $.ajax({
	type:'POST',
	url: 'controller/products/changeView.php',
	data : { value : value },
	success:function(t){
	    new PNotify({
		title: false,
		 text: t,
		 type: 'info',
	    });
	}
    });
}
//---------------------------------------------------------------------------------------------


/*--------------------CHANGE PRODUCT IMAGE----------------------------------------------------
 * 
 */
function changeImage(imageID, productID){
    var src = 'view/img/products/'+ productID +'/big/'+ imageID +'.jpg';
    $('.product-image img').attr("src",src);
}
//--------------------------------------------------------------------------------------------


/*------------------FILL OPTIONS CONTENT---------------------------------------------------
 * 
 */
//For first options
function getOptionsContents(){
    var group = $('[name=group]').val();
    $.ajax({
        type:'POST',
        url: 'view/default/php/php.php',
        data : { 'group': group},
        success:function(t){
            $('[name=options]').find('option').remove();
            $('[name=options]').html(t);
        }
    });
}
//-----------------------------------------------------------------------------------------------


/*------------------------INSERT BUTTON LIKE ADD PRODUCTS----------------------------------------
 * 
 */
$(function(){
    
    $('#insButton').on('click',function() {			        
        $('.sub-menu').toggle(function(){
            $(this).addClass('sub-menu-open')
        });
        
    });
})
//------------------------------------------------------------------------------------------------


/*------------------GET SUB CATEGORY--------------------------------------------------------------
 */
function getSubCategory(){
    var main = $('[name=main]').val();
    $.ajax({
        type:'POST',
        url: 'view/default/php/php.php',
        data : { 'main': main},
        success:function(t){
            $('[name=sub]').find('option').remove();
            $('[name=sub]').html(t);
        }
    });
}
//------------------------------------------------------------------------------------------------


/*---------------FOR ADD CATEGORIES---------------------------------------------------------------
 */
function disableMain(){
    $('input[name="sku"]').hide();
    $('select[name="main"]').hide();
}
function enableMain(){
    $('input[name="sku"]').show();
    $('select[name="main"]').show();
}
//-----------------------------------------------------------------------------------------------



/*---------------DISABLE ATTRIBUTES INPUT FOR ADD SETTINGS---------------------------------------
 */
function disableAttributes(){
    var val = $('.addSettings[name=what]').val();
    if(val == 'brand' || val == 'prefix' || val == 'payType' || val == 'cash' || val == 'themes'){
        $('[name=attributes]').attr('disabled', true);
    }
    else{
        $('[name=attributes]').attr('disabled', false);
    }
}
//-----------------------------------------------------------------------------------------------



/*---------------UPDATE, DELETE OR CHANGE DEFAULT FOR SETTINGS-----------------------------------
 */
function changeSettingOption(id, what){
    var result = window.confirm('Are you sure?');
    if (result == false) {
        e.preventDefault();
    }
    else{
        $.ajax({
            type:'POST',
            url: 'controller/settings/addValue.php',
            data : { 'what': what, 'id': id },
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
//-----------------------------------------------------------------------------------------------

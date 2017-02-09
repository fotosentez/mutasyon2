<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

//For add to cart
$sellProduct = Get::post('sellProduct');
$buyProduct = Get::post('buyProduct');

//For remove item from cart
$removedID = Get::post('removedID');
$key = Get::post('key');

if($sellProduct){
    if(Check::isNumeric($sellProduct, "")){
        $_SESSION['cart'][] = $sellProduct;
        Output::refreshDiv('.topCart .info-number');
        echo "ürün satış sepetine eklendi";
    }
}

if($buyProduct){
    if(Check::isNumeric($buyProduct, "")){
        if(count(@$_SESSION['buyCart'])<= 1){
            $_SESSION['buyCart'][] = $buyProduct;
            Output::refreshDiv('.refreshTopBuyCartSpan');
            Output::refreshDiv('.refreshTopBuyCart');
            Output::refreshDiv('.refreshTopBuyCartTopList');
            Output::cleanSpecialInputs('.autocomplete');
            echo Lang::getLang('productAddedToCart');
        }
        else{
            if( in_array( $buyProduct ,$_SESSION['buyCart']) )
            {
                Output::cleanSpecialInputs('.autocomplete');
                echo Lang::getLang('productAlreadyInCart');
                
            }
            else{
                $_SESSION['buyCart'][] = $buyProduct;
                Output::refreshDiv('.refreshTopBuyCartSpan');
                Output::refreshDiv('.refreshTopBuyCart');
                Output::refreshDiv('.refreshTopBuyCartTopList');
                echo Lang::getLang('productAddedToCart');
            }
        }
    }
}
if($key){
    if($key == "buy"){
        $arr = $_SESSION['buyCart'];
        $_SESSION['buyCart'] = array_diff($arr, array($removedID));
        Output::refreshDiv('.refreshTopBuyCart');
        Output::refreshDiv('.refreshTopBuyCartSpan');
        Output::refreshDiv('.refreshTopBuyCartTopList');
    }
}
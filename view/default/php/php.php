<?php
require_once(dirname(__FILE__).'/../../../model/settings/include.php'); // Get session

/*---------------GET CUSTOMER DISCOUNT-----------------------------
 * Get discount amount from Customers class
 */
$customerId = Get::getValue('customerId');
if($customerId){
    if(preg_match('/^[+0-9. ()\/-]*$/', $customerId)){
        echo Customers::getRow('discount', $customerId);
    }
}
//-----------------------------------------------------------------



/*-----------------------CART-------------------------------
 * For add to cart
 */
$sellProduct = Get::getValue('sellProduct');
$buyProduct = Get::getValue('buyProduct');

if($sellProduct){
    if(Check::control('numeric', $sellProduct, "")){
        if(count(@$_SESSION['cart'])== 0){
            Session::addToCart($sellProduct);
            Output::refreshDiv('.topCart .info-number');
            Output::refreshDiv('.refreshTopCart');
            Output::refreshDiv('.refreshTopCartTopList');
            Output::cleanSpecialInputs('.autocomplete');
            echo Lang::getLang('productAddedToCart');
        }
        else{
            if( in_array( $sellProduct ,$_SESSION['cart']) )
            {
                Output::cleanSpecialInputs('.autocomplete');
                echo Lang::getLang('productAlreadyInCart');
                
            }
            else{
                Session::addToCart($sellProduct);
                Output::refreshDiv('.topCart .info-number');
                Output::refreshDiv('.refreshTopCart');
                Output::refreshDiv('.refreshTopCartTopList');
                Output::cleanSpecialInputs('.autocomplete');
                echo Lang::getLang('productAddedToCart');
            }
        }
    }
}
if($buyProduct){
    if(Check::control('numeric', $buyProduct, "")){
        if(count(@$_SESSION['buyCart']) == 0){
            Session::arrayPush('buyCart', $buyProduct);
            Output::refreshDiv('.refreshTopBuyCartSpan');
            Output::refreshDiv('.refreshTopBuyCart');
            Output::refreshDiv('.refreshTopBuyCartTopList');
            Output::cleanRed('.autocomplete');
            echo Lang::getLang('productAddedToCart');
        }
        else{
            if( in_array( $buyProduct ,$_SESSION['buyCart']) )
            {
                Output::cleanRed('.autocomplete');
                echo Lang::getLang('productAlreadyInCart');
                
            }
            else{
                Session::arrayPush('buyCart', $buyProduct);
                Output::refreshDiv('.refreshTopBuyCartSpan');
                Output::refreshDiv('.refreshTopBuyCart');
                Output::refreshDiv('.refreshTopBuyCartTopList');
                echo Lang::getLang('productAddedToCart');
            }
        }
    }
}



//Remove items from buy and sell cart
$removedID = Get::getValue('removedID');
$key = Get::getValue('key');

if($key){
    if($key == "buy"){
        $arr = $_SESSION['buyCart'];
        $_SESSION['buyCart'] = array_diff($arr, array($removedID));
        Output::refreshDiv('.refreshTopBuyCart');
        Output::refreshDiv('.refreshTopBuyCartSpan');
        Output::refreshDiv('.refreshTopBuyCartTopList');
        Output::refreshDiv('.refreshBuyCart');
    }
    if($key == "sell"){
        $_SESSION['cart'] = array_diff($_SESSION['cart'], array($removedID));
        Output::refreshDiv('.topCart .info-number');
        Output::refreshDiv('.refreshTopCart');
        Output::refreshDiv('.refreshTopCartTopList');
        Output::refreshDiv('.refreshCartTopList');
    }
}
//------------------------------------------------------------------------------------


/*-------------------GET options CONTENTS------------------------------------------
 * 
 */
$group = Get::getValue('group');
if($group){
    if($group != "none"){
        if(Check::control('numeric', $group, "group")){
            foreach(Options::getRow('contents', $group) as $c){
                echo '<option value="'.$c["options_id"].'">'.$c["options_name"].'</option>';
            }
        }
    }
    else{
        echo '<option value="none">'.Lang::getLang("select").'</option>';
    }
}
/*-------------------GET options CONTENTS------------------------------------------
 * 
 */
$main = Get::getValue('main');
if($main){
    if(Check::control('numeric', $main, 'main', true)){
        $sub = Categories::getRow('sub', $main);
        foreach($sub as $c){
            echo '<option value="'.$c["subcategory_id"].'">'.$c["subcategory_name"].'</option>';
        }
    }
}

?>
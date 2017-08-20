<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
/*
 * Contents is contents of options
 * options id is id of products options table
 */
$error = array();
$postedOptions = Get::getValue('postedOptions');
$postedColors = Get::getValue('postedColors');
$productId = Get::getValue('productId');

//------------SETTINGS------------------------
$prID = "po_products_id = ".$productId;
$colorID = "po_colors_id = ".$postedColors;
$optionsID = "po_options_id = ".$postedOptions;
$stepHaveAll = 0;
$stepOnlyColors = 0;
$stepOnlyOptions = 0;
//--------------------------------------------


//Check options tables for products have options or not
$checkOptions = Dbase::isExist('products_options', 'po_products_id = '.$productId);

if($checkOptions){
    
    /*-----------IF COLORS POSTED----------------------------------------------------------------------
     */
    if($postedColors AND !$postedOptions){
        $hasOptionsNull = Dbase::getRow('products_options', ''.$prID.' AND '.$colorID.' AND po_options_id IS NULL', 'po_id');
        
        if($hasOptionsNull){
            $stepOnlyColors = 1;
        }
        else{
            $getColors = Dbase::getRows('po_id, po_options_id', 'products_options', ''.$prID.' AND '.$colorID.' AND po_options_id IS NOT NULL ');
            
            foreach($getColors as $ids){
                array_push($error, $ids['po_options_id']);
            }
            
            //If products have colors and options
            if(!empty($error)){Output::error(true);}
            else{$stepOnlyColors = 1;} 
        }
    }
    //----------------------------------------------------------------------------------------------------
    
    
    
    /*-----------IF OPTIONS POSTED----------------------------------------------------------------------
     */
    else if($postedOptions AND !$postedColors){
        $hasColorsNull = Dbase::getRow('products_options', ''.$prID.' AND '.$optionsID.' AND po_colors_id IS NULL', 'po_id');
        
        if($hasColorsNull){
            $stepOnlyOptions = 1;
        }
        else{
            $getOptions = Dbase::getRows('po_id, po_colors_id', 'products_options', ''.$prID.' AND '.$optionsID.' AND po_colors_id IS NOT NULL ');
            
            foreach($getOptions as $ids){array_push($error, $ids['po_colors_id']);}
            
            //If products have colors and options
            if(!empty($error)){foreach($error as $a){Output::error(true);}}
            else{$stepOnlyOptions = 1;} 
        }
    }
    //----------------------------------------------------------------------------------------------------
    
    
    /*--------------------------IF ALL POSTED------------------------------------------------------------
     */
    else if($postedColors AND $postedOptions){
        $getAll = Dbase::getRows('po_id, po_colors_id, po_options_id', 'products_options', ''.$prID.' AND '.$optionsID.' AND '.$colorID.' ');
        
        $error = array();
        $error = array();
        foreach($getAll as $ids){array_push($error, $ids['po_colors_id']);array_push($error, $ids['po_options_id']);}
        
        if(!empty($error) AND !empty($error)){
            if( in_array( $postedColors ,$error) AND in_array( $postedOptions ,$error) ){
                $stepHaveAll = 1;
            }
            else{
                foreach($error as $a){Output::error(true);}
            }
        }
        else{
            if(empty($error) AND !empty($error)){
                $stepOnlyOptions = 1;
            }
            if(!empty($error) AND empty($error)){
                $stepOnlyColors = 1;
            }
        }
    }
    //--------------------------------------------------------------------------------------------------
    
    else{
        echo Lang::getLang('selectColorOrContents');
        exit();
    }
    
}
else{
    $getSKU = Dbase::getRow('productsView', 'products_id = '.$productId, 'products_id');
    $deneme = $getSKU.",products";
    Session::arrayPush('cart', $deneme);
}


if($stepHaveAll == 1){
    $getSKU = Dbase::getRow('productsView', 'products_id = '.$productId.' AND '.$colorID.' AND '.$optionsID.' ', 'po_id');
    $deneme = $getSKU.",options";
    Session::arrayPush('cart', $deneme);
    Session::arrayPush('buyCart', $deneme);
}
if($stepOnlyColors == 1){
    $getSKU = Dbase::getRow('productsView', 'products_id = '.$productId.' AND '.$colorID.' AND po_options_id ISNULL', 'po_id');
    $deneme = $getSKU.",options";
    Session::arrayPush('cart', $deneme);
    Session::arrayPush('buyCart', $deneme);
}
if($stepOnlyOptions == 1){
    $getSKU = Dbase::getRow('productsView', 'products_id = '.$productId.' AND '.$optionsID.' AND po_colors_id ISNULL', 'po_id');
    $deneme = $getSKU.",options";
    Session::arrayPush('cart', $deneme);
    Session::arrayPush('buyCart', $deneme);
}

?>
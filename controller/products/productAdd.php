<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions

/*********PLEASE USE FOLLOW NAME FOR INPUT NAME AND ITS CLASS*************
 * E.g : <input type="text" name="product_name" class="product_name" />
 * product_name
 * short_desc
 * product_detail
 * categoryId
 * options
 */
$error = array();
$product_name = Get::getValue('product_name');
$short_desc = Get::getValue('short_desc');
$product_detail = Get::getValue('product_detail');
$categoryId = Get::getValue('sub');
$brand = Get::getValue('brand');

$checkOne =0;
if(Check::control('productName', $product_name, "product_name", true)){
    if(Check::control('productName', $short_desc, "short_desc")){
        if(Check::control('productName', $product_detail, "product_detail")){
            if(Check::control('numeric', $categoryId, "categoryId", true)){
                if(Check::control('numeric', $brand, "brand")){
                    if(empty($error)){$checkOne =1;}
                    else{Output::error();}
                }
            }
        }
    }
}

//If short desc, product name, detail and category are valid
if($checkOne == 1){
    
    //Get last prefix of product
    $getPrefixOfCategory = Categories::getRow('subcategory_prefix', $categoryId);
    $getLastSKU = Dbase::getRow('products', 'products_prefix = "'.$getPrefixOfCategory.'"  ORDER BY SKU DESC ', 'SKU');
    
    //Make new SKU
    $SKU = sprintf("%06d", $getLastSKU+1);
    
    //Check for product added before or not
    $checkProduct = Dbase::isExist('products', 'products_name = "'.$product_name.'" and products_category = "'.$categoryId.'"  ');
    if($checkProduct){
        echo Lang::getLang('contentExist');
        exit();
    }
    else{
        if($short_desc == ""){
            $short_desc = $product_name;
        }
        
        //Write inf to db
        $table = 'products';
        $values = array(
            'products_name' => $product_name,
            'products_brand' => $brand,
            'products_short_detail' => $short_desc,
            'products_detail' => $product_detail,
            'products_prefix' => $getPrefixOfCategory,
            'SKU' => $SKU,
            'products_category' => $categoryId,
            );
            $insert = Dbase::insert($table, $values );
            if($insert){
                $getId = Dbase::getRow('products', 'products_name = "'.$product_name.'" and products_category = "'.$categoryId.'" ', 'products_id');
                
                echo '<script type="text/javascript">window.location.href="index.php?u=products/detail&id='.$getId.'";</script>'.Lang::getLang("proccessSuccess");
            }
    }
    
}
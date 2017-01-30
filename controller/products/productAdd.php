<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions


$product_name = Get::post('product_name');
$short_desc = Get::post('short_desc');
$product_detail = Get::post('product_detail');
$category = Get::post('category');
$attributes = Get::post('attributes');

$checkOne =0;
if(Check::isProductName($product_name, "product_name", true)){
    if($short_desc == "" OR Check::isProductName($short_desc, "short_desc")){
        if($product_detail == "" OR Check::isProductDetail($product_detail, "product_detail")){
            if(Check::isNumeric($category, "category", true)){
                if($attributes){
                    foreach($attributes as $a){
                        if(Check::isNumeric($a, "attributes")){
                            $checkOne =1;
                        }
                    }
                }
                else{
                    $checkOne =1;
                }
            }
        }
    }
}

//If short desc, product name, detail and category are valid
if($checkOne == 1){
    
    //Get last prefix of product
    $getPrefixOfCategory = $dbase->getRow('subcategory', 'subcategory_id = '.$category.' ', 'subcategory_prefix');
    $getLastSKU = $dbase->getRow('products', 'products_prefix = "'.$getPrefixOfCategory.'"  ORDER BY SKU DESC ', 'SKU');
    
    //Make new SKU
    $SKU = sprintf("%06d", $getLastSKU+1);
    
    //Check for product added before or not
    $checkProduct = $dbase->isExist('products', 'products_name = "'.$product_name.'" and products_category = "'.$category.'"  ');
    if($checkProduct == 1){
        echo Lang::getLang('contentExist');
        exit();
    }
    else{
        //Write inf to db
        $table = 'products';
        $values = array(
            'products_name' => $product_name,
            'products_short_detail' => $short_desc,
            'products_detail' => $product_detail,
            'products_prefix' => $getPrefixOfCategory,
            'SKU' => $SKU,
            'products_category' => $category,
        );
        $insert = $dbase->insert($table, $values );
        if($insert){
            if($attributes){
                $getId = $dbase->getRow('products', 'products_name = "'.$product_name.'" and products_category = "'.$category.'" ', 'products_id');
                foreach($attributes as $a){
                    $table = 'products_attributes';
                    $values = array(
                        'pa_attributes_content_id' => $a,
                        'pa_products_id' => $getId,
                    );
                    $insert = $dbase->insert($table, $values );
                }
                echo Lang::getLang('proccessSuccess');
                echo '<script>$("div.one").slideUp("slow");$("div.two").addClass("displayBlock")</script>';
            }
            else{
                echo Lang::getLang('proccessSuccess');
                echo '<script>$("div.one").slideUp("slow");$("div.two").addClass("displayBlock")</script>';
            }
        }
    }
    
}
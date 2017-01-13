<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions


$product_name = Get::post('product_name');
$short_desc = Get::post('short_desc');
$product_detail = Get::post('product_detail');
$category = Get::post('category');
if($product_name){
    if(Check::isProductName($product_name, 'product_name')){
        $vname = 1;
    }
    else{
        $vname = 0;
    }
}
else{
    Output::checkError('product_name', 'validateText');
    $vname = 0;
}

//If product name is valid
if($vname == 1){
    if($short_desc){
        if(Check::isProductName($short_desc, 'short_desc')){
            $vshortdesc = 1;
        }
        else{
            $vshortdesc = 0;
        }
    }
    else{
        $vshortdesc = 1;
        $short_desc = $product_name;
    }
}

//If short desc and product name are valid
if($vname == 1 and $vshortdesc == 1){
    if($product_detail){
        if(Check::isProductDetail($product_detail, 'product_detail')){
            $vprdetail = 1;
        }
        else{
            $vprdetail = 0;
        }
    }
    else{
        $vprdetail = 1;
    }
}

//If short desc, product name and detail are valid
if($vname == 1 and $vshortdesc == 1 and $vprdetail == 1){
    if($category){
        if(preg_match('/^[+0-9. ()\/-]*$/', $category)){
            $vcategory = 1;
        }
        else{
            echo Output::checkError('category', 'cantBlank');
            $vcategory = 0;
            exit();
        }
    }
    else{
        $vcategory = 0;
    }
}

//If short desc, product name, detail and category are valid
if($vname == 1 and $vshortdesc == 1 and $vprdetail == 1 and $vcategory == 1){
    Output::cleanRed();
    
    //Get last prefix of product
    $getPrefixOfCategory = $dbase->getRow('subcategory', 'subcategory_main = '.$category.' ', 'subcategory_prefix');
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
            echo Lang::getLang('proccessSuccess');
            echo '<script>$("div.one").slideUp("slow");$("div.two").addClass("displayBlock")</script>';
    }
    
}
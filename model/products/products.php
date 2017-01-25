<?php
//get category id
if(Get::post('cid') AND Check::isNumeric(Get::post('cid'), '')){
    $cid = "AND products_category = ".Get::post('cid');
    $table = "products WHERE products_category = ".Get::post('cid');
    $urlName = "products&cid=".Get::post('cid');
}
else{
    $cid = "";
    $table = "products";
    $urlName = "products";
}

//Get page
//Add paginations
$pagination = AddHtml::addPaginationPhp('products_id', $table, '10', $urlName);

if(Get::post('page') AND Check::isNumeric(Get::post('page'), '')){
    $page = "LIMIT ".$pagination["start"].", 10";
}
else{
    $page = "";
}


//Get all products
$products = $dbase->get('*, (SELECT products_images_id FROM products_images WHERE products_images_product = products_id AND products_images_cover = 1 ) AS cover', 'products', 'products_status = 1 '.$cid.' '.$page.' ');

//Get categories
$main = $dbase->get('*', 'maincategory', 'maincategory_status = 1');
$mainCategories = array();
foreach($main as $c){$mainCategories[] = $c;}

//Get sub categories
$sub = $dbase->get('*', 'subcategory INNER JOIN maincategory ON maincategory_id = subcategory_main', 'subcategory_status = 1');
$subCategories = array();
foreach($sub as $c){$subCategories[] = $c;}

//Smarty veriables
$smarty->assign ( array (
    "products" => $products,
    "mainCategories" => $mainCategories,
    "subCategories" => $subCategories,
    "urlName" => $urlName,
    ) );
Page::create("products/products", 'products', 'products', 'products');
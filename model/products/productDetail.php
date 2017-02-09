<?php

$productId = Get::post("id");
if($productId == ""){
    header('Location: index.php?url=index');
}


$productJoins = "
LEFT JOIN subcategory ON products_category = subcategory_id 
LEFT JOIN boughtProducts ON bp_products_id = products_id
LEFT JOIN tax ON tax_id = bp_tax
";

//Get product inf and cover images
$productDetail = $dbase->get('*, (SELECT products_images_id FROM products_images WHERE products_images_product = products_id AND products_images_cover = 1 ) AS cover', 'products '.$productJoins.' ', 'products_status = 1 AND products_id = "'.$productId.'" ORDER BY bp_id DESC LIMIT 1 ');

//Get product images
$getImages = $dbase->get('*', 'products_images', 'products_images_status = 1 AND products_images_product = "'.$productId.'" ');

//Get product attributes
$getAttributes = $dbase->get('*', 'products_attributes LEFT JOIN attributes_contents ON pa_attributes_content_id = ac_id LEFT JOIN attributes_group ON ac_attributes_group_id = ag_id', 'pa_products_id = '.$productId.' ');
$attr = array();
foreach($getAttributes as $a){
    $attr[] = $a;
}

//Is product attributes exist?
$isAttributes = $dbase->isExist(' products_attributes ',  'pa_products_id = '.$productId.' ');

//Buy actions
$buyActions = $dbase->get('*', 'boughtProducts LEFT JOIN buyInvoice ON bp_bi_id = bi_id LEFT JOIN products ON bp_products_id = products_id LEFT JOIN seller ON bi_seller_id = seller_id LEFT JOIN tax ON tax_id = bp_tax ', 'bp_products_id = '.$productId.' GROUP BY bi_id ');

//Smarty veriables
$smarty->assign ( array (
    "productDetail" => $productDetail,
    "getImages" => $getImages,
    "attr" => $attr,
    "isAttributes" => $isAttributes,
    "buyActions" => $buyActions,
    ) );
    
    Page::create("products/productDetail", "productDetail", "products", "productDetail");
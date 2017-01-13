<?php
//Get main and sub category from database
$getSubCategory = $dbase->get('*', 'subcategory LEFT JOIN maincategory ON subcategory_main = maincategory_id', 'subcategory_status = 1 AND maincategory_status = 1');



//Smarty veriables
$smarty->assign ( array (
        "getSubCategory" => $getSubCategory,
    ) );
    
Page::create("productAdd", Lang::getLang('productAdd'), "productAdd", "productAdd");
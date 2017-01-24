<?php
//Get main and sub category from database
$getSubCategory = $dbase->get('*', 'subcategory LEFT JOIN maincategory ON subcategory_main = maincategory_id', 'subcategory_status = 1 AND maincategory_status = 1 ORDER BY maincategory_name');

//Get main categories
$getMainCategories = $dbase->get('*', 'maincategory', 'maincategory_status = 1');


//Smarty veriables
$smarty->assign ( array (
        "getSubCategory" => $getSubCategory,
        "getMainCategories" => $getMainCategories
));
    
    Page::create("productAdd", "productAdd", "productAdd", "productAdd");
<?php
//Get main and sub category from database
$getSubCategory = $dbase->get('*', 'subcategory LEFT JOIN maincategory ON subcategory_main = maincategory_id', 'subcategory_status = 1 AND maincategory_status = 1 ORDER BY maincategory_name');

//Get main categories
$getMainCategories = $dbase->get('*', 'maincategory', 'maincategory_status = 1');

//Get attributes
$attr = $dbase->get('*', 'attributes_contents INNER JOIN attributes_group ON ag_id = ac_attributes_group_id', 'ac_id <> 0');
$attributesGroup = $dbase->get('*', 'attributes_group INNER JOIN attributes_contents ON ag_id = ac_attributes_group_id', 'ag_id <> 0 GROUP BY ag_name ORDER BY ag_order');
$attributes = array();
foreach($attr as $c){$attributes[] = $c;}


//Smarty veriables
$smarty->assign ( array (
    "getSubCategory" => $getSubCategory,
    "getMainCategories" => $getMainCategories,
    "attributes" => $attributes,
    "attributesGroup" => $attributesGroup,
    ));
    
    Page::create("products/productAdd", "productAdd", "products", "productAdd");
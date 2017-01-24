<?php

$getMainCategories = $dbase->get('*', 'maincategory', 'maincategory_status = 1');


//Smarty veriables
$smarty->assign ( array (
"getMainCategories" => $getMainCategories,
) );
Page::create("categories/addCategory", "addCategory", "addCategory", "addCategory");
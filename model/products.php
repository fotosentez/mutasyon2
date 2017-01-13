<?php
$products = $dbase->get('*', 'products', 'products_status = 1');

//Smarty veriables
$smarty->assign ( array (
    "products" => $products,
    ) );
Page::create("products", Lang::getLang('products'), "products");
<?php

//Get invoice prefixs
$prefix = $dbase->get('*', 'prefix', 'prefix_status = 1 ORDER BY prefix_default DESC');
$products = $dbase->get('*', 'products INNER JOIN sale_price ON sp_products_id = products_id ', 'products_status = 1');

//Smarty veriables
$smarty->assign ( array (
"prefix" => $prefix,
"products" => $products,
) );
Page::create("invoice/addInvoice", 'addInvoice', 'addInvoice', 'addInvoice');
?>
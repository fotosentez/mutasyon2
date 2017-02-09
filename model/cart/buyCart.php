<?php
$cash = $dbase->get('*', 'cash', 'cash_status = 1 ORDER BY cash_default DESC');
$seller = $dbase->get('*', 'seller', 'seller_status = 1 ORDER BY seller_default DESC');
$t = $dbase->get('*', 'tax', 'tax_id <> 0 ORDER BY tax_default DESC');
$payType = $dbase->get('*', 'paytype', 'paytype_id <> 0 ORDER BY paytype_default DESC');
foreach($t as $c){$tax[] = $c;}

//Smarty veriables
$smarty->assign (array(
    "cash" => $cash,
    "tax" => $tax,
    "payType" => $payType,
    "seller" => $seller,
    ));
Page::create("cart/buyCart", "cart", "addInvoice", "cart");
<?php
$cash = $dbase->get('*', 'cash', 'cash_status = 1 ORDER BY cash_default DESC');
$seller = $dbase->get('*', 'seller', 'seller_status = 1 ORDER BY seller_default DESC');
$tax = $dbase->get('*', 'tax', 'tax_id <> 0');
$payType = $dbase->get('*', 'paytype', 'paytype_id <> 0');

//Smarty veriables
$smarty->assign (array(
    "cash" => $cash,
    "tax" => $tax,
    "payType" => $payType,
    "seller" => $seller,
));
Page::create("invoice/addBuyInvoice", 'addBuyInvoice', 'addInvoice', 'addBuyInvoice');
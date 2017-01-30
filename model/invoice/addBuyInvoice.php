<?php
$cash = $dbase->get('*', 'cash', 'cash_status = 1 ORDER BY cash_default DESC');
$tax = $dbase->get('*', 'tax', 'tax_id <> 0');
$payType = $dbase->get('*', 'paytype', 'paytype_id <> 0');

//Smarty veriables
$smarty->assign (array(
    "cash" => $cash,
    "tax" => $tax,
    "payType" => $payType,
));
Page::create("invoice/addBuyInvoice", 'addBuyInvoice', 'addInvoice', 'addBuyInvoice');
<?php
$invoiceJoins = '
INNER JOIN prefix ON invoice_prefix_id = prefix_id
INNER JOIN customers ON invoice_customer_id = customers_id
INNER JOIN superuser ON invoice_superuser_id = superuser_id
LEFT JOIN providers ON providers_id = invoice_providers_id
LEFT JOIN payments ON payments_invoice_id = invoice_id
LEFT JOIN bank ON bank_id = payments_id
';

$extra = '
(SELECT ps_price FROM productsSold WHERE ps_invoice_id = invoice_id) AS productTotal, 
(SELECT ss_price FROM servicesSold WHERE ss_invoice_id = invoice_id) AS servicesTotal
';

$invoice = $dbase->get('*, '.$extra.' ', 'invoice '.$invoiceJoins.' ', 'invoice_cancelled <> 2 LIMIT 100');

//Smarty veriables
$smarty->assign ( array (
"invoice" => $invoice,
) );

Page::create("invoice/invoices", "invoices", "invoices", "invoices");
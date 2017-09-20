<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
require_once(_BASEDIR_.'model/classes/CInvoice.php');

$error = array();

$customer       = Get::getValue('customer');
$date           = Get::getValue('date');
$prefix         = Get::getValue('prefix');
$sku            = Get::getValue('sku');
$status         = Get::getValue('status');
$complaint      = Get::getValue('complaint');
$what           = Get::getValue('what');

//For products invoice
$dueDate        = Get::getValue('dueDate');
$desc           = Get::getValue('desc');
$discount       = Get::getValue('discount');
$amount         = Get::getValue('amount');
$infs           = Get::getValue('infs');
//----------------------------------------------------------------------------------------------------------------------------------

$inv = new CInvoice();

$inv->prefix               = $prefix;
$inv->desc                 = $desc;
$inv->customer             = $customer;
$inv->date                 = $date;
$inv->dueDate              = $dueDate;
$inv->discount             = $discount;
$inv->invoiceType          = "s";

$inserInvoice = $inv->insert($infs, $amount);

?>

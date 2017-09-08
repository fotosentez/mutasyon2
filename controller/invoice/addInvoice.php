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

$stepOne = 0;
$stepProduct = 0;
$stepProductAdd = 0;
//----------------------------------------------------------------------------------------------------------------------------------

$inv = new CInvoice();
$x = 0;

$inv->prefix               = $prefix;
$inv->desc                 = $desc;
$inv->customer             = $customer;
$inv->date                 = $date;
$inv->dueDate              = $dueDate;
$inv->discount             = $discount;
$inv->invoiceType          = "s";

$inserInvoice = $inv->insert();

if($inserInvoice){
    foreach($infs AS $i){
        $a = explode(',', $i);
        
        $inv->productsId         = $a[0];
        $inv->productsType       = $a[1];
        $inv->eachPrice          = $a[3];
        $inv->amountType         = $a[4];
        $inv->amount             = $amount[$x];
        
        
        
        $x++;
    }
    $insertProducts = $inv->insertProducts( $inv->productsType, $inv->productsId, $inserInvoice, $x );
    if($insertProducts){
        echo Lang::getLang('proccessSuccess');
    }
    else{
        $inv->removeNullInvoice( $inserInvoice );
    }
    
}

?>

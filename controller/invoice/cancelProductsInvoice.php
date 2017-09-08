<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
require_once(_BASEDIR_.'model/classes/CBuyInvoice.php');
$error              = array();
$descArray          = array();

//Return arrays
$returns            = array();

$invoiceId          = Get::getValue('invoiceId');
$password           = Get::getValue('password');
$cashId             = Get::getValue('cashId');
$payType            = Get::getValue('payType');
$date               = Get::getValue('date');
$refund             = Get::getValue('refund');
$desc               = Get::getValue('desc');

//Arrays
$psId               = Get::getValue('psId');


$stepInvoice        = 0;
$stepPayments       = 0;
$stepPayments       = 0;

if(Check::control('numeric', $invoiceId, 'invoiceId', true)){
    if(Check::control('desc', $password, 'password', true)){
        if(Check::control('date', $date, 'date', true)){
            if(Check::control('numeric', $refund, 'refund')){
                
                /*-------------------------------------------------------------------
                 * 
                 */
                if($psId){
                    foreach($psId as $p){
                        $status = Get::getValue('status'.$p);
                        $solution = Get::getValue('solution'.$p);
                        $amount = Get::getValue('amount'.$p);
                        $reason = Get::getValue('reason'.$p);
                        if($reason == "notLike" OR $reason == "damaged" OR $reason == "other"){
                            if(Check::control('numeric', $amount, 'amount'.$p, true)){
                                if($status == "good" OR $status == "worn"){
                                    if($solution == "return" OR $solution == "change"){
                                        if($status == "good"){
                                            if($solution == "return"){
                                                include(dirname(__FILE__).'/return.php');
                                            }
                                        }
                                        else{
                                            //Buraya yıpranmış ürünler gelecek
                                        }
                                    }
                                    else{
                                        array_push($error, 'solution'.$p.',validateText');
                                    }
                                }
                                else{
                                    array_push($error, 'status'.$p.',validateText');
                                }
                            }
                        }
                        else{
                            array_push($error, 'reason'.$p.',validateText');
                        }
                    }
                }
                else{
                    array_push($error, 'psId,select');
                }
                //-------------------------------------------------------------------
                
                
            }
        }
    }
}

if(empty($error)){
    
    $buy = new CBuyInvoice();
    $buy->desc              = 'İade edilen ürünlerin olşturduğu faturadır';
    $buy->adminId           = $_SESSION['mutasyon_login'];
    $buy->customer          = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_customer_id');
    $buy->date              = $date;
    $buy->cashId            = $cashId;
    $buy->payType           = $payType;
    $buy->buyPayment        = $refund;
    $buy->invoiceId         = $invoiceId;
    $buy->isVirtual         = 'off';
    
    $buy->newInvoiceId = $buy->insert();
    $stepInvoice = 1;
    echo "Fatura oluşturuldu";
    
    //If invoice was made
    if($buy->newInvoiceId){
        foreach($returns AS $r){
            $a = explode('-', $r);
            
            $getProductsId          = $a[0];
            $getWhat                = $a[1];
            $buy->amount            = $a[2];
            $buy->eachPrice         = $a[3];
            $getSolution            = $a[4];
            $insertProducts = $buy->insertProducts($getWhat, $getProductsId);
        }
        
        $stepProducts = 1;
        echo "Ürünler eklendi";
        
        
    }
    
    
    if($insertProducts){
        //Add payment if not virtual products
        if($buy->isVirtual != "on"){
            $buy->insertPayments($buy->newInvoiceId);
            $stepPayments = 1;
            echo "Ödeme yapıldı";
        }
        else{
            $stepPayments = 1;
        }
    }
    else{
        $buy->removeEmptyInvoice($buy->newInvoiceId);
    }
    
    if($stepInvoice == 1 AND $stepProducts == 1 AND $stepPayments == 1){
        $cancel = Dbase::updateOneRow('invoice', 'invoice_cancelled = 1 ', 'invoice_id = '.$invoiceId);
        if($cancel){
            echo "Eski fatura iptal edildi";
        }
    }
    
}
else{
    Output::error();
}

?>

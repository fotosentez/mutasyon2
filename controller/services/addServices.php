<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions

$error = array();

$invoiceId = Get::getValue('invoiceId');
$services = Get::getValue('services');
$amount = Get::getValue('amount');
$price = Get::getValue('price');

//---------------------------ADD SERVICE INVOICE----------------------------------------
$stepAddService = 0;
if($services){
    if(Check::control('numeric', $services, 'services', true)){
        if(Check::control('numeric', $invoiceId, 'invoiceId', true)){
            if(Check::control('numeric', $amount, 'amount', true)){
                if(Check::control('numeric', $price, 'price', true)){
                    if(empty($error)){
                        $stepAddService = 1;
                    }
                    else{
                        Output::error();
                    }
                }
            }
        }
    }
}

if($stepAddService == 1){
    
    $checkPayment = Dbase::getRow('invoiceView',  'invoice_id = '.$invoiceId, 'payments');
    $getStatus = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_status');
    if($checkPayment == 0){
        if($getStatus == 0){
            $table = 'servicesSold';
            $values = array(
                'ss_invoice_id' => $invoiceId,
                'ss_services_id' => $services,
                'ss_amount' => $amount,
                'ss_price' => $price
                );
                $insertInvoice = Dbase::insert($table, $values );
                
                echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
        }
        else{
            echo Lang::getLang('cantAddServiceInvoiceCompromise');
            exit();
        }
    }
    else{
        echo Lang::getLang('cantAddServiceInvoicePaid');
        exit();
    }
}
//------------------------------------------------------------------------------------------




//-----------------------------COMPROMISE---------------------------------------------------
$dueDate = Get::getValue('dueDate');
$discount = Get::getValue('discount');
$discountType = Get::getValue('discountType');

$stepCompromise = 0;
if($dueDate){
    if(Check::control('date', $dueDate, 'dueDate', true)){
        if(Check::control('numeric', $invoiceId, 'invoiceId', true)){
            if($discount != '0.00'){
                if(Check::control('numeric', $discount, 'discount')){
                    if(empty($error)){
                        $findInvoiceTotal = Services::findTotal('total', $invoiceId);
                        $calcDiscount = Harizmi::getRow('discount', array('discount' => $discount, 'price' => $findInvoiceTotal, 'method' => $discountType));
                        
                        if($calcDiscount <= $findInvoiceTotal){
                            $stepCompromise = 1;
                            $wDiscount = $discount;
                        }
                        else{
                            Output::addRed('discount', 'validateDiscount');
                            exit();
                        }
                    }
                    else{
                        Output::error();
                    }
                }
            }
            else{
                if(empty($error)){
                    $stepCompromise = 1;
                    $wDiscount = NULL;
                    $wDiscountType = NULL;
                }
                else{
                    Output::error();
                }
            }
        }
    }
}

if($stepCompromise == 1){
    $getService = Dbase::getRow('servicesSold', 'ss_invoice_id = '.$invoiceId, 'ss_services_id');
    
    if($wDiscount != NULL){
        if($discountType == 'amount' OR $discountType == 'percent'){
            if($getService > 0){
                $table = 'invoice';
                $values = array(
                    'invoice_discount' => $wDiscount,
                    'invoice_discount_type' => $discountType,
                    'invoice_due_date' => $dueDate,
                    'invoice_status' => 1
                    );
                    $updateInvoice = Dbase::update($table,  $values, 'invoice_id = '.$invoiceId);
                    
                    echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
            }
            else{
                echo Lang::getLang('pleaseAddServiceFirst');
                exit();
            }
        }
        else{Output::addRed('discountType', 'validateText');exit();}
    }
    else{
        if($getService > 0){
            $table = 'invoice';
            $values = array(
                'invoice_discount' => $wDiscount,
                'invoice_discount_type' => $wDiscountType,
                'invoice_due_date' => $dueDate,
                'invoice_status' => 1
                );
                $updateInvoice = Dbase::update($table,  $values, 'invoice_id = '.$invoiceId);
                
                echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
        }
        else{
            echo Lang::getLang('pleaseAddServiceFirst');
            exit();
        }
    }
}
//----------------------------------------------------------------------------------------------------

?>
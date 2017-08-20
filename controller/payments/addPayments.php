<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
$error = array();


//For invoice payments
$invoiceId = Get::getValue('invoiceId');



//For buy invoice
$buyInvoiceId = Get::getValue('buyInvoiceId');
$sellerId = Get::getValue('sellerId');


$cashId = Get::getValue('cashId');
$payType = Get::getValue('payType');
$amount = Get::getValue('amount');
$desc = Get::getValue('desc');
$date = Get::getValue('date');
$superuserId = @$_SESSION["mutasyon_login"];
$what = Get::getValue('what');



$stepInvoice = 0;
$stepProviders = 0;
if(Check::control('numeric', $invoiceId, 'invoiceId', true)){
    if(Check::control('numeric', $cashId, 'cashId', true)){
        if(Check::control('numeric', $amount, 'amount', true)){
            if(Check::control('date', $date, 'date', true)){
                $checkPayType = Dbase::isExist('settings', 's_name = "payType" AND s_id = '.$payType);
                if($checkPayType){
                    if(empty($error)){
                        if($what == 'invoicePayments'){
                            if($desc){if(Check::control('productName', $desc, 'desc')){$stepInvoice = 1;}}
                            else{$stepInvoice = 1;}
                        }
                        else if($what == 'providersPayments'){
                            if($desc){if(Check::control('productName', $desc, 'desc')){$stepProviders = 1;}}
                            else{$stepProviders = 1;}
                        }
                    }
                    else{
                        Output::error();
                    }
                }
                else{
                    echo Lang::getLang('payTypeNotFound');
                    exit();
                }
            }
        }
    }
}



//-------------------------ADD INVOICE PAYMENTS-----------------------------------------------------------------------
if($stepInvoice == 1){
    
    $getStatus = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_status');
    
    if($getStatus == 1){
        $getCustomerId = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_customer_id');
        if($desc){$invDesc = $desc;}else{$invDesc = Invoice::getRow('no', $invoiceId).Lang::getLang('addInvPayment');}
        
        //Find and check invoice total
        
        if(Invoice::getRow('invoiceTotal', $invoiceId)){
            $getTotal = Invoice::findTotal('total', $invoiceId);
            $payments = Invoice::getRow('payments', $invoiceId);
        }
        else{
            $getTotal = Services::findTotal('total', $invoiceId);
            $payments = Services::getRow('payments', $invoiceId);
        }
        
        
        if($amount <= ($getTotal-$payments)){$invAmount = $amount;}else{echo Output::addRed('amount', 'payCantBigTotal');exit();}
        
        $table = 'payments';
        $values = array(
            'payments_customers_id' => $getCustomerId,
            'payments_invoice_id' => $invoiceId,
            'payments_cash_id' => $cashId,
            'payments_superuser_id' => $superuserId,
            'payments_type' => $payType,
            'payments_category' => 'invoice',
            'payments_in_out' => "in",
            'payments_amount' => $invAmount,
            'payments_desc' => $invDesc,
            'payments_date' => $date,
            );
            
            $insert = Dbase::insert($table, $values );
            if($insert){
                echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
            }
    }
    else{
        echo Lang::getLang('cantPaidDeactiveInvoice');
        exit();
    }
}
//--------------------------------------------------------------------------------------------------------------------------


if($stepProviders == 1){
    $getProviderFee = Dbase::getRow('invoiceView', 'invoice_id = '.$invoiceId, 'invoice_providers_price');
    $getProviderPayTotal = Dbase::getRow('invoiceView', 'invoice_id = '.$invoiceId, 'providersPaid');
    $getStatus = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_status');
    
    if($getStatus == 1){
        if($amount <= ($getProviderFee - $getProviderPayTotal)){
            $getProvidersId = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_providers_id');
            
            //-------------------------------PAYMENTS DESC-------------------------------------------------
            if($desc){$invDesc = $desc;}
            else{
                $invDesc = Providers::getRow('providers_name', $getProvidersId)." ".Lang::getLang('payToProvidersDesc')." ".Lang::getLang('invoiceNo').": ".Invoice::getRow('no', $invoiceId).", ".Lang::getLang('total').": ".Settings::getRow('currency', 'default')." ".$getProviderFee.", ".Lang::getLang('remain').": ".Settings::getRow('currency', 'default')." ".($getProviderFee - $getProviderPayTotal - $amount);  
            }
            //----------------------------------------------------------------------------------------------
            
            $table = 'payments';
            $values = array(
                'payments_providers_id' => $getProvidersId,
                'payments_invoice_id' => $invoiceId,
                'payments_cash_id' => $cashId,
                'payments_superuser_id' => $superuserId,
                'payments_type' => $payType,
                'payments_category' => 1,
                'payments_in_out' => "out",
                'payments_amount' => $amount,
                'payments_desc' => $invDesc,
                'payments_date' => $date,
                );
                
                $insert = Dbase::insert($table, $values );
                if($insert){
                    echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
                }
        }
        else{
            echo Output::addRed('amount', 'payCantBigTotal');exit();
        }
    }
    else{
        echo Lang::getLang('cantPaidDeactiveInvoice');
        exit();
    }
        
}


?>
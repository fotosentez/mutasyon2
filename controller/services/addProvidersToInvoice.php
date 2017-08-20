<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions

$error = array();

$invoiceId = Get::getValue('invoiceId');
$providers = Get::getValue('providers');
$fee = Get::getValue('fee');


$stepOne = 0;
if(Check::control('numeric', $invoiceId, 'invoiceId', true)){
    if(Check::control('numeric', $providers, 'providers', true)){
        if(Check::control('numeric', $fee, 'fee', true)){
            if(empty($error)){
                $stepOne = 1;
            }
            else{
                Output::error();
            }
        }
    }
}

if($stepOne == 1){
    $checkProvider = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId.'', 'invoice_providers_id');
    $checkCancelled = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId.'', 'invoice_cancelled');
    $checkTotal = Dbase::getRow('invoiceView', 'invoice_id = '.$invoiceId.'', 'serviceTotal');
    
    if($fee <= $checkTotal){
        if($checkCancelled == 0){
            if(empty($checkProvider)){
                $table = 'invoice';
                $values = array(
                    'invoice_providers_id' => $providers,
                    'invoice_providers_price' => $fee
                    );
                    $updateInvoice = Dbase::update($table,  $values, 'invoice_id = '.$invoiceId);
                    
                    echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
            }
            else{
                echo Lang::getLang('providersExist');
                exit();
            }
        }
        else{
            return false;
        }
    }
    else{
        echo Lang::getLang('cantFeeBigToTotal');
        exit();
    }
}

?>
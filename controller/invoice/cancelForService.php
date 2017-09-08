<?php

$isPaid = Dbase::getRow('invoiceView', 'invoice_id = '.$invoiceId, 'payments');
$isPaidToProviders = Dbase::getRow('invoiceView', 'invoice_id = '.$invoiceId, 'providersPaid');


if($isPaid > 0){
    $getCustomerId = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_customer_id');
    $getInvoiceNo = Services::getRow('no', $invoiceId);
    $invDesc = $getInvoiceNo.Lang::getLang('returnPayOut')." ".Lang::getLang('paidTotal').": ".Settings::getRow('currency', 'default').$isPaid;
    
    $table = 'payments';
    $values = array(
        'payments_customers_id' => $getCustomerId,
        'payments_invoice_id' => $invoiceId,
        'payments_cash_id' => $cashId,
        'payments_superuser_id' => $_SESSION["mutasyon_login"],
        'payments_type' => $payType,
        'payments_category' => 'return',
        'payments_in_out' => "out",
        'payments_amount' => $isPaid,
        'payments_desc' => $invDesc,
        'payments_date' => IbniYunus::getDate('now'),
        );
        
        $insert = Dbase::insert($table, $values );
}
if($isPaidToProviders > 0){
    $getProviderId = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_providers_id');
    $invDesc = $getInvoiceNo.Lang::getLang('returnPayIn')." ".Lang::getLang('paidTotal').": ".Settings::getRow('currency', 'default').$isPaidToProviders;
    
    $table = 'payments';
    $values = array(
        'payments_providers_id' => $getProviderId,
        'payments_invoice_id' => $invoiceId,
        'payments_cash_id' => $cashId,
        'payments_superuser_id' => $_SESSION["mutasyon_login"],
        'payments_type' => $payType,
        'payments_category' => 'return',
        'payments_in_out' => "in",
        'payments_amount' => $isPaidToProviders,
        'payments_desc' => $invDesc,
        'payments_date' => IbniYunus::getDate('now'),
        );
        
        $insert = Dbase::insert($table, $values );
}

//Update invoice status
$table = 'invoice';
$values = array(
    'invoice_desc' => $descNew,
    'invoice_cancelled' => 1
    );
    $update = Dbase::update($table,  $values, 'invoice_id = '.$invoiceId);
    echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
    
    ?>

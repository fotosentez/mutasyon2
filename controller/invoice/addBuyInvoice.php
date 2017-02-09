<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

$amount = Get::post('amount');
$price = Get::post('price');
$productID = Get::post('productID');
$cartTotal = Get::post('cartTotal');

$sellerId = Get::post('sellerId');
$buyDecs = Get::post('buyinvoicedesc');
$date = Get::post('date');
$adminId = $dbase->getAdminInf('superuser_id');
$paytype = Get::post('paytype');
$tax = Get::post('tax');
$method = Get::post('method');
$profit = Get::post('profit');


$isVirtual = Get::post('virtual');
$buyPayment = Get::post('buypayment');
$cash = Get::post('cash');



$stepOne = 0;
$stepTwo = 0;
if(Check::isNumeric($sellerId, "seller-name", true)){
    //Check for seller exist or not
    $isSellerExist = $dbase->isExist('seller', 'seller_id = '.$sellerId.' ');
    if($isSellerExist == 1){
        if($buyDecs == "" OR Check::isProductDetail($buyDecs, "buyinvoicedesc")){
            if(Check::isDate($date, "date", true)){
                if(Check::isNumeric($cartTotal, "cartTotal", true)){
                    if($isVirtual == "on"){
                        $stepOne = 1;
                    }
                    else{
                        if(Check::isNumeric($buyPayment, "buypayment", true)){
                            if(Check::isNumeric($cash, "cash", true)){
                                if(Check::isNumeric($paytype, "paytype", true)){
                                    if($buyPayment <= $cartTotal){
                                        $stepOne = 1;
                                    }
                                    else{
                                        echo Output::checkError("buypayment", "payCantBigTotal");
                                        exit();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
else{
    echo Output::checkError('sellerId', 'sellerNotFound');
    exit();
}
if($stepOne == 1){
    $number = 0;
    if($productID){
        foreach($productID as $pn){
            if(Check::isProductName($productID[$number], "productID".$pn."")){
                if(Check::isNumeric($amount[$number], "amount".$pn."", true)){
                    if(Check::isNumeric($price[$number], "price".$pn."", true)){
                        $productExist = $dbase->getRow('products', 'products_status = 1 AND products_id = '.$productID[$number].' ', 'products_id');
                        if($productExist){
                            if(Check::isNumeric($tax[$number], "tax".$pn."", true)){
                                $checkTax = $dbase->isExist('tax', 'tax_id = '.$tax[$number].'');
                                if($checkTax == 1){
                                    if($method[$number] == "percent" OR $method[$number] == "amount"){
                                        if(Check::isNumeric($profit[$number], "profit".$pn."", true)){
                                            $stepTwo = 1;
                                        }
                                    }
                                    else{
                                        Output::checkError("method".$pn."", "errorChangeValue");
                                        exit();
                                    }
                                }
                                else{
                                    Output::checkError("tax".$pn."", "taxNotFound");
                                    exit();
                                }
                            }
                        }
                        else{
                            Output::checkError("buyProductList'.$pn.'", "productNotFound");
                            exit();
                        }
                    }
                }
            }
            $number++;
        }
    }
}


if($stepTwo == 1 AND $stepOne == 1){    
    $i = 0;
    
    //Add invoice
    if($buyDecs == ""){
        $buyDecs = $date.Lang::getLang("descOfAddInvoice");
    }
    $getLastNo = $dbase->getRow('buyInvoice', 'bi_id <> 0 ORDER BY bi_no DESC', 'bi_no');
    $newNo = sprintf("%06d", $getLastNo+1);
    
    $table = 'buyInvoice';
    $values = array(
        'bi_detail' => $buyDecs,
        'bi_superuser_id' => $adminId,
        'bi_no' => $newNo,
        'bi_seller_id' => $sellerId,
        'bi_date' => $date,
        );
        $insert = $dbase->insert($table, $values );
        $getInvoiceId = $dbase->getRow('buyInvoice', 'bi_superuser_id = '.$adminId.' ORDER BY bi_id DESC ', 'bi_id');
        
        //If invoice was made
        if($getInvoiceId){
            foreach($productID as $pn){
                $productExistb = $dbase->getRow('products', 'products_status = 1 AND products_id = '.$productID[$i].' ', 'products_id');
                $table = 'boughtProducts';
                $values = array(
                    'bp_products_id' => $productExistb,
                    'bp_amount' => $amount[$i],
                    'bp_price' => $price[$i],
                    'bp_tax' => $tax[$i],
                    'bp_profit' => $profit[$i],
                    'bp_profit_method' => $method[$i],
                    'bp_bi_id' => $getInvoiceId,
                    'bp_date' => $date,
                    );
                    $insert = $dbase->insert($table, $values );
                    $i++;
            }
            if($isVirtual != "on"){
                $payments = 'payments';
                $vpayments = array(
                    'payments_bi_id' => $getInvoiceId,
                    'payments_seller_id' => $sellerId,
                    'payments_cash_id' => $cash,
                    'payments_superuser_id' => $adminId,
                    'payments_type_id' => $paytype,
                    'payments_in_out' => "out",
                    'payments_amount' => $cartTotal,
                    'payments_desc' => $newNo.Lang::getLang('addBuyPayment'),
                    'payments_date' => $date,
                    );
                    $insert = $dbase->insert($payments, $vpayments );
            }
            //             @$_SESSION['buyCart'] = "";
            //             echo '<script type="text/javascript">window.location.href="index.php?url=buyInvoices/id='.$getInvoiceId.'";</script>'.Lang::getLang("proccessSuccess");
        }
}
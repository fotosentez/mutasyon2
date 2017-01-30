<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

$sellerId = Get::post('sellerId');
$buyDecs = Get::post('buyinvoicedesc');
$date = Get::post('date');
$total = Get::post('total');
$adminId = $dbase->getAdminInf('superuser_id');
$tax = Get::post('tax');
$paytype = Get::post('paytype');


$isVirtual = Get::post('virtual');
$buyPayment = Get::post('buypayment');
$cash = Get::post('cash');


$productName = Get::post('productname');
$amount = Get::post('amount');
$price = Get::post('price');
$salePrice = Get::post('salePrice');

$stepOne = 0;
$stepTwo = 0;
if(Check::isNumeric($sellerId, "seller-name", true)){
    //Check for seller exist or not
    $isSellerExist = $dbase->isExist('seller', 'seller_id = '.$sellerId.' ');
    if($isSellerExist == 1){
        if($buyDecs == "" OR Check::isProductDetail($buyDecs, "buyinvoicedesc")){
            if(Check::isDate($date, "date", true)){
                if(Check::isNumeric($tax, "tax", true)){
                    if($paytype == "" OR Check::isNumeric($paytype, "paytype")){
                        if(Check::isNumeric($total, "total", true)){
                            if($isVirtual == "on"){
                                $stepOne = 1;
                            }
                            else{
                                if(Check::isNumeric($buyPayment, "buypayment", true)){
                                    if(Check::isNumeric($cash, "cash", true)){
                                        if($buyPayment <= $total){
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
}
if($stepOne == 1){
    $number = 0;
    if($productName){
        foreach($productName as $pn){
            if(Check::isProductName($productName[$number], "productname".($number+1)."")){
                if(Check::isNumeric($amount[$number], "amount".($number+1)."", true)){
                    if(Check::isNumeric($price[$number], "price".($number+1)."", true)){
                        if(Check::isNumeric($salePrice[$number], "salePrice".($number+1)."", true)){
                            $productExist = $dbase->getRow('products', 'products_status = 1 AND products_name = "'.$productName[$number].'"', 'products_id');
                            if($productExist){
                                $stepTwo = 1;
                            }
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
    if($buyDecs == ""){
        $buyDecs = $date." tarihli satın alım faturası";
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
        
        if($getInvoiceId){
            foreach($productName as $pn){
                $productExistb = $dbase->getRow('products', 'products_status = 1 AND products_name = "'.$productName[$i].'"', 'products_id');
                $table = 'boughtProducts';
                $values = array(
                    'bp_products_id' => $productExistb,
                    'bp_amount' => $amount[$i],
                    'bp_price' => $price[$i],
                    'bp_bi_id' => $getInvoiceId,
                    'bp_date' => $date,
                    );
                    $insert = $dbase->insert($table, $values );
                    
                    //Add new price to table
                    $prices = 'sale_price';
                    $pvalues = array(
                        'sp_tax_id' => $tax,
                        'sp_price' => $salePrice[$i],
                        'sp_products_id' => $productExist,
                        'sp_products_date' => $date,
                        );
                        $insert = $dbase->insert($prices, $pvalues );
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
                    'payments_amount' => $total,
                    'payments_desc' => $newNo.Lang::getLang('addBuyPayment'),
                    'payments_date' => $date,
                    );
                    $insert = $dbase->insert($payments, $vpayments );
            }
            echo "tamam";
        }
}
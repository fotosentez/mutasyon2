<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

//This inf for product invoice and service invoice both
$customerId = Get::post('cId');
$date = Get::post('date');
$dueDate = Get::post('dueDate');
$prefix = Get::post('prefix');
$invoiceType = Get::post('invoiceType');
$desc = Get::post('desc');
$discountType = Get::post('discountType');
$discount = Get::post('discount');
$total = Get::post('total');
$adminId = $dbase->getAdminInf('superuser_id');


//For Product invoice only
$productName = Get::post('productname');
$amount = Get::post('amount');

//Check customers and other
$stepOne = 0;
$stepProduct=0;
$stepService = 0;
if(Check::isNumeric($customerId, "customer-name")){
    $getCustomer = $dbase->getRow('customers', 'customers_status = 1 AND customers_id = '.$customerId.' ', 'customers_id');
    if($getCustomer){
        if(Check::isDate($date, "date")){
            if(Check::isDate($dueDate, "dueDate")){
                if( strtotime($date) <= strtotime($dueDate) ){
                    if(Check::isNumeric($prefix, "prefix")){
                        if(Check::isNumeric($discount, 'discount') OR $discount == ""){
                            if($discountType == "percent" OR $discountType == "same"){
                                if(Check::isProductName($desc, "desc") OR $desc == ""){
                                    if(Check::isNumeric($total, "total")){
                                        if($discountType AND $discountType == "percent"){
                                            if($discount <= 100){
                                                if($invoiceType == "product"){
                                                    $stepProduct=1;
                                                }
                                                else if($invoiceType == "service"){
                                                    $stepService=1;
                                                }
                                            }
                                            else{
                                                Output::checkError("discount", "validateDiscount");
                                                exit();
                                            }
                                        }
                                        if($discountType AND $discountType == "same"){
                                            if($discount <= $total){
                                                if($invoiceType == "product"){
                                                    $stepProduct=1;
                                                }
                                                else if($invoiceType == "service"){
                                                    $stepService=1;
                                                }
                                            }
                                            else{
                                                Output::checkError("discount", "validateDiscount");
                                                exit();
                                            }
                                        }
                                    }
                                }
                            }
                            else{
                                Output::checkError("discountType", "validateText");
                                exit();
                            }
                        }
                    }
                }
                else{
                    Output::checkError("dueDate", "doeDateCantSmall");
                    exit();
                }
            }
        }
    }
    else{
        Output::checkError("customer-name", "validateText");
        exit();
    }
}

//If a product invoice
if($stepProduct == 1){
    $number = 0;
    if($productName){
        foreach($productName as $pn){
            if(preg_match('/^[^<>;=#{}]*$/ui', $productName[$number])){
                $productExist = $dbase->getRow('products INNER JOIN boughtProducts ON bp_products_id = products_id', 'products_status = 1 AND products_name = "'.$productName[$number].'"', 'bp_amount');
                if($productExist){
                    if($productExist >= $amount[$number]){
                        $stepOne=1;
                    }
                    else{
                        echo Lang::getLang("notEnoughStock");
                        echo "<script>$('#row".($number+1)." input').addClass('alert-danger')</script>";
                        exit();
                    }
                }
                else{
                    echo Lang::getLang("productNotFound");;
                    echo "<script>$('#row".($number+1)." input').addClass('alert-danger')</script>";
                    exit();
                }
                $number++;
            }
            else{
                echo Lang::getLang("validateText");
                echo "<script>$('#row".($number+1)." input').addClass('alert-danger')</script>";
                exit();
            }
            
        }
    }
}

// If products and other infs are validate then add product invoice and reduce product amount
if($stepOne==1 AND $stepProduct == 1){
    
    
    $getPrefix = $dbase->getRow('prefix', 'prefix_status = 1 AND prefix_id = '.$prefix.' ', 'prefix_name');
    $getLastNo = $dbase->getRow('invoice', 'invoice_prefix_id = '.$prefix.' ORDER BY invoice_id DESC ', 'invoice_no');
    $newNo = sprintf("%06d", $getLastNo+1);
    if($discount){
        $discountType = $discountType;
    }
    else{
        $discountType = "";
    }
    
    $table = 'invoice';
    $values = array(
        'invoice_prefix_id' => $prefix,
        'invoice_no' => $newNo,
        'invoice_desc' => $desc,
        'invoice_superuser_id' => $adminId,
        'invoice_customer_id' => $getCustomer,
        'invoice_discount' => $discount,
        'invoice_discount_type' => $discountType,
        'invoice_date' => $date,
        'invoice_due_date' => $dueDate,
        );
        $insertInvoice = $dbase->insert($table, $values );
        $getInvoiceId = $dbase->getRow('invoice', 'invoice_superuser_id = 1 ORDER BY invoice_id DESC ', 'invoice_id');
        
        if($insertInvoice){
            $x = 0;
            foreach($productName as $f){
                $getProduct = $dbase->get('*', 'products INNER JOIN sale_price ON sp_products_id = products_id INNER JOIN tax ON tax_id = sp_tax_id LEFT JOIN boughtProducts ON bp_products_id = products_id ', 'products_status = 1 AND products_name = "'.$productName[$x].'" ');
                foreach($getProduct as $p){
                    $SKU = $p["SKU"];
                    $name = $p["products_name"];
                    $pPrefix = $p["products_prefix"];
                    $pId = $p["products_id"];
                    $pPrice = $p["sp_price"];
                    $pTax = $p["tax_id"];
                    $pamount = $p["bp_amount"];
                    
                    $table = 'productsSold';
                    $values = array(
                        'ps_invoice_id' => $getInvoiceId,
                        'ps_products_id' => $pId,
                        'ps_amount' => $amount[$x],
                        'ps_price' => $pPrice,
                        'ps_tax_id' => $pTax,
                    );
                    $insertProducts = $dbase->insert($table, $values );
                        
                    //reduce product amount
                    $update = $dbase->updateOneRow("boughtProducts",  "bp_amount = bp_amount - ".$amount[$x]." ", "bp_products_id = ".$pId." ");
                    
                    $x++;
                }
            }
        }
        echo '<script type="text/javascript">window.location.href="index.php?url=invoices/id='.$getInvoiceId.'";</script>'.Lang::getLang("proccessSuccess");
}

//If a service invoice
if($stepService == 1){
    require_once(dirname(__FILE__).'/addServiceInvoice.php');
}


?>
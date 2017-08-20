<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions

$error = array();

$customer = Get::getValue('customer');
$date = Get::getValue('date');
$prefix = Get::getValue('prefix');
$sku = Get::getValue('sku');
$status = Get::getValue('status');
$complaint = Get::getValue('complaint');
$what = Get::getValue('what');

//For invoice
$dueDate = Get::getValue('dueDate');
$desc = Get::getValue('desc');
$discount = Get::getValue('discount');
$discountType = Get::getValue('discountType');
$productID = Get::getValue('productID');

$stepOne = 0;
$stepProduct = 0;
$stepProductAdd = 0;
if(Check::control('numeric', $customer, 'customer', true)){
    if(Check::control('date', $date, 'date', true)){
        if(Check::control('numeric', $prefix, 'prefix', true)){
            if(Check::control('productName', $sku, 'sku', true)){
                if(Check::control('productName', $status, 'status', true)){
                    if(Check::control('productName', $complaint, 'complaint', true)){
                        
                        //---------INVOICE----------------------------------------
                        if($what == "invoice"){
                            if(Check::control('date', $dueDate, 'dueDate', true)){
                                if(Check::control('numeric', $discount, 'discount')){
                                    if(Check::control('numeric', $discountType, 'discountType')){
                                        if(empty($error)){
                                            if($dueDate >= $date){
                                                $stepProduct = 1;
                                            }
                                            else{
                                                echo Output::addRed('dueDate', 'dueDateCantSmall');
                                                exit();
                                            }
                                        }
                                        else{
                                            Output::error();
                                        }
                                    }
                                }
                            }
                        }
                        //---------------------------------------------------------
                        
                        
                        //------------SERVICE--------------------------------------
                        else if($what == "service"){
                            if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
                            else{Output::error();}
                        }
                        //----------------------------------------------------------
                        else{exit();}
                    }
                }
            }
        }
    }
}


if($stepProduct == 1){
    $number = 0;
    $x = 1;
    foreach($productID as $pr){
        if(Check::control('numeric', $pr, 'products'.$pr)){
            if(Check::control('numeric', $amount[$number], 'amount'.$pr)){
                if($amount[$number] > 0){
                    $productExist = Dbase::isExist('products', 'products_id = '.$pr);
                    if($productExist){
                        $stock = Dbase::getRow('productsView', 'products_id = '.$pr, 'stock');
                        if($stock >= $amount[$number]){
                            $stepOne=1;
                            $stepProductAdd=1;
                        }
                        else{
                            echo Output::checkError('amount'.$pr, 'notEnoughStock');
                            exit();
                        }
                    }
                    else{
                        echo Output::checkError('products'.$pr, 'productNotFound');
                        exit();
                    }
                }
                else{
                    Output::checkError('amount'.$pr, 'validateText');
                    exit();
                }
            } 
        }
        $number++;
        $x++;
    }
}


if($stepOne == 1){
    
    $getInvoicePrefixName = Dbase::getRow('settings', 's_id = '.$prefix, 's_value'); //Get prefix name from prefix id
    $getLastInvoiceNo = Invoice::getRow('lastNo', $prefix); //Get last invoice no of that prefix
    $newNo = Build::buildNewNo($getLastInvoiceNo); //Build new no
    
    if($what == "service"){
        $newDesc = Lang::getLang('sku')." : ".$sku."<br />".Lang::getLang('status').": ".$status."<br />".Lang::getLang('complaint').": ".$complaint;
        $invoiceType = "s";
        $invoiceStatus = 0;
        $invoiceDueDate = Null;
        $invoiceDiscount = Null;
        $invoiceDiscountType = Null;
    }
    else if($what == "invoice" AND $stepProductAdd == 1){
        if($desc){$newDesc = $desc;}else{$newDesc = "";}
        $invoiceType = "i";
        $invoiceStatus = 1;
        $invoiceDueDate = $dueDate;
        $invoiceDiscount = $discount;
        $invoiceDiscountType = $discountType;
    }
    else{
        exit();
    }
    
    
    $table = 'invoice';
    $values = array(
        'invoice_prefix_id' => $prefix,
        'invoice_no' => $newNo,
        'invoice_desc' => $newDesc,
        'invoice_superuser_id' => $_SESSION["mutasyon_login"],
        'invoice_customer_id' => $customer,
        'invoice_discount' => $invoiceDiscount,
        'invoice_discount_type' => $invoiceDiscountType,
        'invoice_date' => $date,
        'invoice_due_date' => $invoiceDueDate,
        'invoice_type' => $invoiceType,
        'invoice_status' => $invoiceStatus 
        );
        $insertInvoice = Dbase::insert($table, $values );
        
        if($stepProductAdd == 1){
            $getInvoiceId = Dbase::getRow('invoice', 'invoice_superuser_id = '.$_SESSION["mutasyon_login"].' ORDER BY invoice_id DESC ', 'invoice_id');
            
            $x = 0;
            foreach($productID as $f){
                
                
                
                $table = 'productsSold';
                $values = array(
                    'ps_invoice_id' => $getInvoiceId,
                    'ps_products_id' => $f,
                    'ps_amount' => $amount[$x],
                    'ps_price' => Products::getRow('total', $f)
                    );
                    $insertProducts = Dbase::insert($table, $values );
                    
                    $getAmount = Products::getRow('amount', $f);
                    $newAmount = $getAmount-$amount[$x];
                    
                    //reduce product amount
                    $update = Dbase::updateOneRow('purchasedProducts', 'pp_amount = '.$newAmount.'', 'pp_products_id = '.$f.'');
                    
                    $x++;
            }
        }
        $getInvoiceId = Dbase::getRow('invoice', 'invoice_superuser_id = '.$_SESSION["mutasyon_login"].' ORDER BY invoice_id DESC ', 'invoice_id');
        echo '<script type="text/javascript">window.location.href="index.php?u=invoices/detail&id='.$getInvoiceId.'";</script>'.Lang::getLang("proccessSuccess");
}

?>
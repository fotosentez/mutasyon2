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
$amount = Get::getValue('amount');
$productType= Get::getValue('productType');

$stepOne = 0;
$stepProduct = 0;
$stepProductAdd = 0;

/*----------------CHECK POSTED VALUES FOR SERVICE AND PRODUCTS-------------------------------------------------
 * 
 */
if(Check::control('numeric', $customer, 'customer', true)){
    if(Check::control('date', $date, 'date', true)){
        if(Check::control('numeric', $prefix, 'prefix', true)){
            //---------INVOICE----------------------------------------
            if($what == "invoice"){
                if(Check::control('date', $dueDate, 'dueDate', true)){
                    if(Check::control('numeric', $discount, 'discount')){
                        if(Check::control('desc', $desc, 'desc')){
                            if($discount){
                                if($discountType == "percent" OR $discountType == "amount"){
                                    if($dueDate >= $date){
                                        $stepProduct = 1;
                                    }
                                    else{
                                        array_push($error, 'dueDate,dueDateCantSmall');
                                    }
                                }
                                else{
                                    array_push($error, 'discountType,validateText');
                                }
                            }
                            else{
                                if($dueDate >= $date){
                                    $stepProduct = 1;
                                }
                                else{
                                    array_push($error, 'dueDate,dueDateCantSmall');
                                }
                            }
                        }
                    }
                }
            }
            //---------------------------------------------------------
            
            
            //------------SERVICE--------------------------------------
            else if($what == "service"){
                if(Check::control('desc', $sku, 'sku', true)){
                    if(Check::control('desc', $complaint, 'complaint', true)){
                        if(Check::control('desc', $status, 'status', true)){
                            if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
                            else{Output::error();}
                        }
                    }
                }
            }
            //----------------------------------------------------------
            else{exit();}
        }
    }
}
//----------------------------------------------------------------------------------------------------------



/*----------------CHECK PRODUCTS FOR ADD PRODUCTS INVOICE----------------------------------------------------
 * 
 */
if($stepProduct == 1){
    $number = 0;
    foreach($productID as $pr){
        if(Check::control('numeric', $pr, 'products'.$pr)){
            if(Check::control('numeric', $amount[$number], 'amount'.$pr)){
                if($amount[$number] > 0){
                    //if product
                    if($productType[$number] == 'products'){
                        $productExist = Dbase::isExist('products', 'products_id = '.$pr);
                    }
                    //if options
                    else if($productType[$number] == 'options'){
                        $productExist = Dbase::isExist('products_options', 'po_id = '.$pr);
                    }
                    
                    
                    if($productExist){
                        
                        //if product
                        if($productType[$number] == 'products'){
                            $stock = Dbase::getRow('purchasedProducts', 'products_id = '.$pr, 'sum(pp_amount)');
                        }
                        //if options
                        else if($productType[$number] == 'options'){
                            $stock = Dbase::getRow('purchasedProducts', 'pp_products_options_id = '.$pr, 'sum(pp_amount)');
                        }
                        
                        //Check stock
                        if($stock >= $amount[$number]){
                            $stepOne=1;
                            $stepProductAdd=1;
                        }
                        else{
                            array_push($error, 'amount'.$pr.',notEnoughStock');
                        }
                    }
                    else{
                        array_push($error, $pr.',productNotFound');
                    }
                }
                else{
                    array_push($error, 'amount'.$pr.',validateText');
                }
            } 
        }
        $number++;
    }
}
//-------------------------------------------------------------------------------------------------------------





/*------------------ADD SERVICE OR PRODUCTS INVOICE------------------------------------------------------------
 * 
 */
if(empty($error)){
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
            
            if($stepProductAdd == 1 AND $insertInvoice){
                $getInvoiceId = Dbase::getRow('invoice', 'invoice_superuser_id = '.$_SESSION["mutasyon_login"].' ORDER BY invoice_id DESC ', 'invoice_id');
                
                $x = 0;
                foreach($productID as $f){
                    
                    //if product
                    if($productType[$x] == 'products'){
                        $opt = NULL;
                        $prd = $f;
                        
                        $getInfs = Dbase::getRows('pp_price, pp_profit, pp_profit_method', 'purchasedProducts', 'products_id = '.$f.' ORDER BY pp_id DESC');
                        
                        foreach($getInfs as $p){
                            $profit = $p['pp_profit'];
                            $prc = $p['pp_price'];
                            $method = $p['pp_profit_method'];
                            
                            $price = Harizmi::getRow('total', array('profit' => $profit, 'price' => $prc, 'method' => $method));
                        }
                        
                    }
                    //if options
                    else if($productType[$x] == 'options'){
                        $opt = $f;
                        $prd = Dbase::getRow('products_options', 'po_id = '.$f, 'po_products_id');
                        
                        $getInfs = Dbase::getRows('pp_price, pp_profit, pp_profit_method', 'purchasedProducts', 'pp_products_options_id = '.$f.' ORDER BY pp_id DESC');
                        
                        foreach($getInfs as $p){
                            $profit = $p['pp_profit'];
                            $prc = $p['pp_price'];
                            $method = $p['pp_profit_method'];
                            
                            $price = Harizmi::getRow('total', array('profit' => $profit, 'price' => $prc, 'method' => $method));
                        }
                    }
                    
                    $table = 'productsSold';
                    $values = array(
                        'ps_invoice_id' => $getInvoiceId,
                        'ps_products_id' => $prd,
                        'ps_products_options_id' => $opt,
                        'ps_amount' => $amount[$x],
                        'ps_price' => $price
                        );
                        $insertProducts = Dbase::insert($table, $values );
                        
                        
                        //Reduce product or options amount
                        if($insertProducts){
                            
                            //if product
                            if($productType[$x] == 'products'){
                                $update = Dbase::updateOneRow('purchasedProducts', 'pp_amount = pp_amount - '.$amount[$x], 'pp_products_id = '.$f);
                            }
                            //if options
                            else if($productType[$x] == 'options'){
                                $update = Dbase::updateOneRow('purchasedProducts', 'pp_amount = pp_amount - '.$amount[$x], 'pp_products_options_id = '.$f);
                            }
                            
                            
                        }
                        else{
                            echo Lang::getLang('writeProductsError');
                            exit();
                        }
                        
                        
                        
                        $x++;
                }
            }
            else{
                echo Lang::getLang('writeInvoiceError');
                exit();
            }
            $getInvoiceId = Dbase::getRow('invoice', 'invoice_superuser_id = '.$_SESSION["mutasyon_login"].' ORDER BY invoice_id DESC ', 'invoice_id');
            
            
            //-----------REMOVE ITEMS FROM CART-----------------------------------
            foreach(Cart::getRow('cart') as $b => $k){
                $a = explode(',', $k);
                if($a[2] == 'cart'){
                    $_SESSION['cart'] = array_diff($_SESSION['cart'], [$k]);
                }
            }
            //-------------------------------------------------------------------------------------
            
            
            //-------------REDIRECT FROM INVOICE PAGE------------------------------
            echo '<script type="text/javascript">window.location.href="index.php?u=invoices/detail&id='.$getInvoiceId.'";</script>'.Lang::getLang("proccessSuccess");
            //--------------------------------------------------------------------------------------
    }
}
else{
    Output::error(true);
}
//----------------------------------------------------------------------------------------------------------------------------------
?>

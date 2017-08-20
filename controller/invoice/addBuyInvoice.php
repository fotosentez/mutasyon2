<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
$error = array();

//Common
$sellerId = Get::getValue('sellerId');
$desc = Get::getValue('desc');
$date = Get::getValue('date');
$what = Get::getValue('what');
$adminId = $_SESSION['mutasyon_login'];

//This for virtual product or not
$isVirtual = Get::getValue('virtual');
$buyPayment = Get::getValue('buypayment');
$cash = Get::getValue('cash');
$payType = Get::getValue('payType');

//Array
$productID = Get::getValue('productID');
$amount = Get::getValue('amount');
$amountType = Get::getValue('amountType');
$price = Get::getValue('eachPrice');
$profit = Get::getValue('profit');
$profitType = Get::getValue('profitType');
$eachPrice = Get::getValue('eachPrice');
if(!$productID){exit();}




//Get cart total for check pay to seller
$cartTotal = Get::getValue('subTotal');


$stepOne = 0;
$stepTwo = 0;

//--------------------------CHECK VALUES-------------------------------------------------------------------
if(Check::control('numeric', $sellerId, 'sellerId', true)){
    if(Check::control('productName', $desc, 'desc')){
        if(Check::control('date', $date, 'date', true)){
            if(Check::control('numeric', $adminId, '', true)){
                if(Check::control('numeric', $buyPayment, 'buypayment')){
                    if(Check::control('numeric', $cash, 'cash')){
                        $sellerExist = Dbase::isExist('seller', 'seller_id = '.$sellerId);
                        if(Check::control('exist', $sellerExist, 'sellerId', true)){
                            if($isVirtual != "on"){
                                $checkPayType = Dbase::isExist('settings', 's_name = "payType" AND s_id = '.$payType);
                                if($checkPayType){
                                    $cashExist = Dbase::isExist('settings', 's_name = "cash" AND s_id = '.$cash);
                                    if(Check::control('exist', $cashExist, 'cash', true)){
                                        if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
                                        else{Output::error();}
                                    }
                                }
                                else{
                                    echo Lang::getLang('payTypeNotFound');
                                    exit();
                                }
                            }
                            else{
                                if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
                                else{Output::error();}
                            }
                        }
                    }
                }
            }
        }
    }
}


if($stepOne == 1){
    $x = 0;
    $total = 0;
    foreach($productID as $p){
        if(Check::control('numeric', $productID[$x], $p, true)){
            if(Check::control('numeric', $amount[$x], 'amount'.$p, true)){
                if(Check::control('numeric', $amountType[$x], 'amountType'.$p, true)){
                    if(Check::control('numeric', $eachPrice[$x], 'eachPrice'.$p, true)){
                        if(Check::control('numeric', $profit[$x], 'profit'.$p, true)){
                            if($what[$x] == 'options' OR $what[$x] == 'products'){
                                if($profitType[$x] == 'percent' OR $profitType[$x] == 'amount'){
                                    if(empty($error)){
                                        $findTotal = $amount[$x]*$eachPrice[$x];
                                        $total += $findTotal;
                                    }
                                    else{Output::error(true);}
                                }
                                else{
                                    echo Lang::getLang('wrongProfitType');
                                    exit();
                                }
                            }
                            else{
                                echo Lang::getLang('wrongWhat');
                                exit();
                            }
                        }
                    }
                }
            }
        }
        $x++;
    }
}
//--------------------------------------------------------------------------------------------------------



//----------------------------CHECK TOTAL-----------------------------------------------------------------
if($isVirtual != "on"){
    if($buyPayment <= $total){
        $stepTwo = 1;
    }
    else{
        Output::addRed('buypayment', 'payCantBigTotal');
        exit();
    }
}
else{
    $stepTwo = 1;
}



//------------------------------ADD BUYINVOICE------------------------------------------------------------
if($stepTwo == 1){
    $i = 0;
    
    //Add invoice
    if($desc == ""){$desc = $date.Lang::getLang("descOfAddInvoice");}
    
    $getLastNo = BuyInvoices::getRow("lastNo");
    $newNo = Build::buildNewNo($getLastNo);
    
    $table = 'buyInvoice';
    $values = array(
        'bi_detail' => $desc,
        'bi_superuser_id' => $adminId,
        'bi_no' => $newNo,
        'bi_seller_id' => $sellerId,
        'bi_date' => $date,
        );
        $insert = Dbase::insert($table, $values );
        $getInvoiceId = Dbase::getRow('buyInvoice', 'bi_superuser_id = '.$adminId.' AND bi_no = "'.$newNo.'" ORDER BY bi_id DESC ', 'bi_id');
        
        //If invoice was made
        if($getInvoiceId){
            foreach($productID as $pn){
                if($what[$i] == 'options'){
                    $getProductsId = Dbase::getRow('products_options', 'po_id = '.$pn, 'po_products_id');
                    $prId = $getProductsId;
                    $opId = $pn;
                }
                else if($what[$i] == 'products'){
                    $prId = $pn;
                    $opId = NULL;
                }
                
                
                $table = 'purchasedProducts';
                $values = array(
                    'pp_products_id' => $prId,
                    'pp_products_options_id' => $opId,
                    'pp_amount' => $amount[$i],
                    'pp_amount_type' => $amountType[$i],
                    'pp_price' => $price[$i],
                    'pp_profit' => $profit[$i],
                    'pp_profit_method' => $profitType[$i],
                    'pp_bi_id' => $getInvoiceId,
                    );
                    $insert = Dbase::insert($table, $values );
                    $i++;
            }
            
            //Add payment if not virtual products
            if($isVirtual != "on"){
                $payments = 'payments';
                $vpayments = array(
                    'payments_bi_id' => $getInvoiceId,
                    'payments_seller_id' => $sellerId,
                    'payments_cash_id' => $cash,
                    'payments_superuser_id' => $adminId,
                    'payments_type' => $payType,
                    'payments_category' => 'invoice',
                    'payments_in_out' => "out",
                    'payments_amount' => $buyPayment,
                    'payments_desc' => $newNo.Lang::getLang('addBuyPayment'),
                    'payments_date' => $date,
                    );
                    $insert = Dbase::insert($payments, $vpayments );
            }
            Session::build("cart", Array());
            echo '<script type="text/javascript">window.location.href="index.php?u=buyInvoices/id='.$getInvoiceId.'";</script>'.Lang::getLang("proccessSuccess");
        }
}

?>
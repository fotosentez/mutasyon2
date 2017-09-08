<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
require_once(_BASEDIR_.'model/classes/CBuyInvoice.php'); 
$error = array();

//Common
$sellerId = Get::getValue('sellerId');
$customer = Get::getValue('customer');
$desc = Get::getValue('desc');
$date = Get::getValue('date');
$what = Get::getValue('what');//Products type like products or options
$adminId = $_SESSION['mutasyon_login'];

//This for virtual product or not
$isVirtual = Get::getValue('virtual');//For pay seller
$buyPayment = Get::getValue('buypayment');//Pay amount of seller or customer
$cashId = Get::getValue('cashId');
$payType = Get::getValue('payType');//payment type like cash or credit card

//Array
$productID = Get::getValue('productID');
$amount = Get::getValue('amount');
$amountType = Get::getValue('amountType');//Amount type like piece or golon
$profit = Get::getValue('profit');
$profitType = Get::getValue('profitType');//Profit type like percent or amount
$eachPrice = Get::getValue('eachPrice');//Price of buy
if(!$productID){exit();}



$stepOne = 0;
$stepTwo = 0;

//--------------------------CHECK VALUES-------------------------------------------------------------------
if(Check::control('numeric', $sellerId, 'sellerId', true)){
    if(Check::control('desc', $desc, 'desc')){
        if(Check::control('date', $date, 'date', true)){
            if(Check::control('numeric', $adminId, '', true)){
                if(Check::control('numeric', $buyPayment, 'buypayment')){
                    if(Check::control('numeric', $cashId, 'cashId')){
                        $sellerExist = Dbase::isExist('seller', 'seller_id = '.$sellerId);
                        if(Check::control('exist', $sellerExist, 'sellerId', true)){
                            if($isVirtual != "on"){
                                $checkPayType = Dbase::isExist('settings', 's_name = "payType" AND s_id = '.$payType);
                                if($checkPayType){
                                    $cashExist = Dbase::isExist('settings', 's_name = "cash" AND s_id = '.$cashId);
                                    if(Check::control('exist', $cashExist, 'cashId', true)){
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
    $buy = new CBuyInvoice();
    $buy->desc = $desc;
    $buy->adminId = $adminId;
    $buy->sellerId = $sellerId;
    $buy->customer = $customer;
    $buy->date = $date;
    $buy->cashId = $cashId;
    $buy->payType = $payType;
    $buy->buyPayment = $buyPayment;
    $buy->isVirtual = $isVirtual;
    
    
    $buy->invoiceId = $buy->insert();
    
    //If invoice was made
    if($buy->invoiceId){
        foreach($productID as $pn){
            $buy->amount = $amount[$i];
            $buy->amountType = $amountType[$i];
            $buy->eachPrice = $eachPrice[$i];
            $buy->profit = $profit[$i];
            $buy->profitType = $profitType[$i];
            
            $buy->insertProducts($what[$i], $pn);
            
            $i++;
        }
        
        //Add payment if not virtual products
        if($buy->isVirtual != "on"){
            $buy->insertPayments($buy->invoiceId);
        }
        
        
        //-----------REMOVE ITEMS FROM CART-----------------------------------
        foreach(Cart::getRow('cart') as $b => $k){
            $a = explode(',', $k);
            if($a[2] == 'buyCart'){
                $_SESSION['cart'] = array_diff($_SESSION['cart'], [$k]);
            }
        }
        //--------------------------------------------------------------------
        
        echo '<script type="text/javascript">window.location.href="index.php?u=buyInvoices/id='.$buy->invoiceId.'";</script>'.Lang::getLang("proccessSuccess");
    }
}

?>

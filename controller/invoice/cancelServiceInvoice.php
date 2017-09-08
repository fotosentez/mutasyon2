<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
$error = array();

$invoiceId = Get::getValue('invoiceId');
$password = Get::getValue('password');
$reason = Get::getValue('reason');
$cashId = Get::getValue('cashId');
$payType = Get::getValue('payType');

$stepOne = 0;
if(Check::control('numeric', $invoiceId, 'invoiceId', true)){
    $checkStatus = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_cancelled');
    if($checkStatus == 0){
        if(Check::control('desc', $password, 'password', true)){
            if(Check::control('desc', $reason, 'reason', true)){
                if(Check::numberOfCharacters($reason, 30, 200,  'reason')){
                    if(Check::control('numeric', $payType, 'payType', true)){
                        if(Check::control('numeric', $cashId, 'cashId', true)){
                            $checkPayType = Dbase::isExist('settings', 's_name = "payType" AND s_id = '.$payType);
                            $checkCash = Dbase::isExist('settings', 's_name = "cash" AND s_id = '.$cashId);
                            if($checkPayType){
                                if($checkCash){
                                    $stepOne = 1;
                                }
                                else{
                                    array_push($error, 'cashId,cashNotFound');
                                } 
                            }
                            else{
                                array_push($error, 'payType,payTypeNotFound');
                            }
                        }
                    }
                }
            }
        }
    }
    else{
        exit();
    }
}

if($stepOne == 1 AND empty($error)){
    $getPassword = Superuser::getRow('superuser_password');
    
    if(isset($_SESSION["checkPassword"])){
        if($_SESSION["checkPassword"] > 0){
            if(md5($password) == $getPassword){
                $descBefore = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_desc');
                $descNew = $descBefore."<br />".Lang::getLang('reason').": ".$reason;
                
                //All data send to cancelForService for write to database
                include_once(dirname(__FILE__).'/cancelForService.php');
            }
            else{
                $_SESSION["checkPassword"]--;  
                echo $_SESSION["checkPassword"];
            }
        }
        else{
            Session::destroy();
            echo '<script type="text/javascript">setTimeout(location.reload.bind(location), 500);</script>';
        }
    }
    else{
        Session::build('checkPassword', 3);
    }
}
else{
    Output::error();
}

?>

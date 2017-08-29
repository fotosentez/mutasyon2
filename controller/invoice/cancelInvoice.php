<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
$error = array();

$invoiceId = Get::getValue('invoiceId');
$password = Get::getValue('password');
$reason = Get::getValue('reason');
$cashId = Get::getValue('cashId');
$payType = Get::getValue('payType');
$what = Get::getValue('what');

$stepOne = 0;
if(Check::control('numeric', $invoiceId, 'invoiceId', true)){
    $checkStatus = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_cancelled');
    if($checkStatus == 0){
        if(Check::control('desc', $password, 'password', true)){
            if(Check::control('desc', $reason, 'reason', true)){
                if(Check::control('numeric', $cashId, 'cashId', true)){
                    if(empty($error)){
                        if(Check::numberOfCharacters($reason, 30, 200,  'reason')){
                            if($payType == "invoice" OR $payType == "transfer" OR $payType == "return"){
                                $stepOne = 1;
                            }
                            else{
                                echo Lang::getLang('payTypeNotFound');
                                exit();
                            }
                        }
                    }
                    else{
                        Output::error();
                    }
                }
            }
        }
    }
    else{
        exit();
    }
}

if($stepOne == 1){
    $getPassword = Superuser::getRow('superuser_password');
    
    if(isset($_SESSION["checkPassword"])){
        if($_SESSION["checkPassword"] > 0){
            if(md5($password) == $getPassword){
                $descBefore = Dbase::getRow('invoice', 'invoice_id = '.$invoiceId, 'invoice_desc');
                $descNew = $descBefore."<br />".Lang::getLang('reason').": ".$reason;
                
                if($what == "service"){
                    include_once(dirname(__FILE__).'/cancelForService.php');
                }
                else if($what == "invoice"){
                    include_once(dirname(__FILE__).'/cancelForInvoice.php');
                }
                else{
                    exit();
                }
                
                $table = 'invoice';
                $values = array(
                    'invoice_desc' => $descNew,
                    'invoice_cancelled' => 1
                    );
                    $update = Dbase::update($table,  $values, 'invoice_id = '.$invoiceId);
                    echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
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

?>

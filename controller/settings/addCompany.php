<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
$error = array();

$name = Get::getValue('name');
$phone = Get::getValue('phone');
$address = Get::getValue('address');
$web = Get::getValue('web');
$mail = Get::getValue('mail');


$stepOne = 0;
if(Check::control('name', $name, 'name', true)){
    if(Check::control('numeric', $phone, 'phone')){
        if(Check::control('address', $address, 'address')){
            if(Check::control('url', $web, 'web')){
                if(Check::control('mail', $mail, 'mail')){
                    if(empty($error)){
                        $stepOne = 1;
                    }
                    else{
                        Output::error();
                    }
                }
            }
        }
    }
}

if($stepOne == 1){
    $check = Dbase::isExist('company', 'company_name = "'.$name.'" ');
    
    if(!$check){
        
        $checkDefault = Dbase::isExist('company', 'company_default = 1');
        if($checkDefault){  $default = 0;   }else{  $default = 1;   }
        
        $table = 'company';
        $values = array(
            'company_name' => $name,
            'company_address' => $address,
            'company_web' => $web,
            'company_mail' => $mail,
            'company_tel' => $phone,
            'company_default' => $default,
            );
            $insert = Dbase::insert($table, $values );
            
            if($insert){
                echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
            }
            
    }
    else{
        echo Lang::getLang('contentExist');
        exit();
    }
}
?>
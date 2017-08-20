<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
$error = array();
$name = Get::getValue('name');
$connectedPerson = Get::getValue('connectedPerson');
$phone = Get::getValue('phone');
$address = Get::getValue('address');
$web = Get::getValue('web');
$mail = Get::getValue('mail');

$stepOne = 0;
if(Check::control('name', $name, 'name', true)){
    if(Check::control('name', $connectedPerson, 'connectedPerson')){
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
}

if($stepOne == 1){
    
    $table = 'seller';
    
    $values = array(
        'seller_name' => $name,
        'seller_connected_person' => $connectedPerson,
        'seller_address' => $address,
        'seller_tel' => $phone,
        'seller_mail' => $mail,
        'seller_web' => $web,
        'seller_add_date' => IbniYunus::getDate('now'),
        );
        
        $insert = Dbase::insert($table, $values );
        
        echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
        
}

?>
<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

//Get posted infs
$name = Get::post("name");
$phone = Get::post("phone");
$address = Get::post("address");
$web = Get::post("web");
$mail = Get::post("mail");
$addDate = Get::post("addDate");
$iban = Get::post("iban");

if(Check::isName($name, "name", true)){
    if(Check::isNumeric($phone, "phone") OR $phone == ""){
        if(Check::isAddress($address, "address") OR $address == ""){
            if($mail == "" OR Check::isEmail($mail, "mail")){
                if($web == "" OR Check::isUrl($web, "web")){
                    if(Check::isDate($addDate, "addDate")){
                        if($iban == "" OR Check::checkIBAN($iban, "iban")){
                            $isProviderExist = $dbase->isExist('seller', 'seller_name = "'.$name.'" ');
                            if($isProviderExist != 1){
                                $table = 'seller';
                                $values = array(
                                    'seller_name' => $name,
                                    'seller_IBAN' => $iban,
                                    'seller_tel' => $phone,
                                    'seller_address' => $address,
                                    'seller_web' => $web,
                                    'seller_mail' => $mail,
                                    'seller_add_date' => $addDate,
                                    );
                                    $insert = $dbase->insert($table, $values );
                                    echo Lang::getLang("proccessSuccess");
                                    Output::cleanAllInputs();
                            }
                            else{
                                echo Lang::getLang('contentExist');
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }
}
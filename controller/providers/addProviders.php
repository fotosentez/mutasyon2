<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

//Get posted infs
$name = Get::post("name");
$phone = Get::post("phone");
$address = Get::post("address");
$web = Get::post("web");
$mail = Get::post("mail");
$addDate = Get::post("addDate");
$connectedPerson = Get::post("connectedPerson");

if(Check::isName($name, "name", true)){
    if(Check::isNumeric($phone, "phone") OR $phone == ""){
        if(Check::isAddress($address, "address") OR $address == ""){
            if($mail == "" OR Check::isEmail($mail, "mail")){
                if($web == "" OR Check::isUrl($web, "web")){
                    if(Check::isDate($addDate, "addDate")){
                        if($connectedPerson == "" OR Check::isName($connectedPerson, "connectedPerson")){
                            $isProviderExist = $dbase->isExist('providers', 'providers_name = "'.$name.'" ');
                            if($isProviderExist != 1){
                                $table = 'providers';
                                $values = array(
                                    'providers_name' => $name,
                                    'providers_connected_person' => $name,
                                    'providers_tel' => $phone,
                                    'providers_address' => $address,
                                    'providers_web' => $web,
                                    'providers_mail' => $mail,
                                    'providers_add_date' => $addDate,
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
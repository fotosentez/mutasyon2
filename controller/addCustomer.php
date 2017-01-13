<?php
require_once(dirname(__FILE__).'/../model/settings/settings.php'); // Get All Functions


// Get informations
$name = Get::post ( "name" );
$addDate = Get::post ( "addDate" );
$surname = Get::post ( "surname" );
$address = Get::post ( "address" );
$phone = Get::post ( "phone" );
$mail = Get::post ( "mail" );
$city = Get::post ( "city" );
$country = Get::post ( "country" );
$group = Get::post ( "group" );

// Check name and surname
if(Check::isName($name, 'name') AND Check::isName($surname, 'surname') AND Check::isDate($addDate, 'addDate')){
    $vname = 1;
    $vsurname = 1;
    $vaddDate = 1;
}
else{
    $vname = 0;
    $vsurname = 0;
    $vaddDate = 0;
}

// Check other inputs
if($vname == 1 and $vsurname == 1 and $vaddDate == 1){
    if($address){
        if(Check::isAddress($address, 'address')){
            $vaddress = 1;
        }
        else{
            $vaddress = 0;
        }
    }
    else{
        $vaddress = 1;
    }
    if($phone){
        if(Check::isNumeric($phone, 'phone')){
            $vphone = 1;
        }
        else{//if address not valid
            $vphone = 0;
        }
    }
    else{
        $vphone = 1;
    }
    if($mail){
        if(Check::isEmail($mail, "mail")){
            $vmail = 1;
        }
        else{//if mail not valid
            $vmail = 0;
        }
    }
    else{
        $vmail = 1;
    }
    if($city){
        if(Check::isName($city, 'city')){
            $vcity = 1;
        }
        else{//if address not valid
            $vcity = 0;
        }
    }
    else{
        $vcity = 1;
    }
    if($country){
        if(Check::isName($country, 'country')){
            $vcountry = 1;
        }
        else{//if address not valid
            $vcountry = 0;
        }
    }
    else{
        $vcountry = 1;
    }
    if($group){
        if(Check::isNumeric($group, 'group') OR $group == "noGroup"){
            $vgroup = 1;
        }
        else{//if address not valid
            $vgroup = 0;
        }
    }
    else{
        $vgroup = 1;
    }
}
//Write infs
if($vname == 1 and $vsurname == 1 and $vaddress == 1 and $vphone == 1 and $vmail ==1 and $vcity == 1 and $vcountry == 1 and $vgroup ==1){
    $checkCustomer = $dbase->isExist('customers', 'customers_name = "'.$name.'" and customers_surname = "'.$surname.'"  ');
    
    if($checkCustomer == 1){
        echo Lang::getLang('contentExist');
        exit();
    }
    else{
        $table = 'customers';
        if($group == "noGroup"){
            $ngroup = 0;
        }
        else{
            $ngroup = $group;
        }
        $values = array(
            'customers_name' => $name,
            'customers_surname' => $surname,
            'customers_address' => $address,
            'customers_phone' => $phone,
            'customers_mail' => $mail,
            'customers_country' => $country,
            'customers_city' => $city,
            'customers_group' => $ngroup,
            'customers_addDate' => $addDate,
            );
            $insert = $dbase->insert($table, $values );
            echo Lang::getLang('proccessSuccess');
    }
}
else{
    return false;
}
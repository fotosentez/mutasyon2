<?php
require_once(dirname(__FILE__).'/../model/settings/settings.php'); // Get All Functions


// Get informations
$name = Get::post ( "name" );
$surname = Get::post ( "surname" );
$address = Get::post ( "address" );
$phone = Get::post ( "phone" );
$mail = Get::post ( "mail" );
$city = Get::post ( "city" );
$country = Get::post ( "country" );
$group = Get::post ( "group" );

// Check name and surname
if($name){
    if(Validation::isName($name)){
        $vname = 1;
        if($surname){
            if(Validation::isName($surname)){
                Output::checkError('');
                $vsurname = 1;
            }
            else{//if surname not a valid
                echo Lang::getLang('validateName');
                Output::checkError('surname');
                $vsurname = 0;
            }
        }
        else{//if surname not posting
            echo Lang::getLang('validateName');
            Output::checkError('surname');
            $vsurname = 0;
        }
    }
    else{//is not a name
        echo Lang::getLang('validateName');
        Output::checkError('name');
        $vname = 0;
    }
}
else{//if name sot posting
    echo Lang::getLang('validateName');
    Output::checkError('name');
    $vname = 0;
}

// Check other inputs
if($vname == 1 and $vsurname == 1){
    if($address){
        if(Validation::cleanHtmlCode($address)){
            $vaddress = 1;
        }
        else{//if address not valid
            echo Lang::getLang('validateName');
            Output::checkError('address');
            $vaddress = 0;
        }
    }
    else{
        $vaddress = 1;
    }
    if($phone){
        if(Validation::isNumeric($phone)){
            $vphone = 1;
        }
        else{//if address not valid
            echo Lang::getLang('validateName');
            Output::checkError('phone');
            $vphone = 0;
        }
    }
    else{
        $vphone = 1;
    }
    if($mail){
        if(Validation::isEmail($mail)){
            $vmail = 1;
        }
        else{//if address not valid
            echo Lang::getLang('validateMail');
            Output::checkError('mail');
            $vmail = 0;
        }
    }
    else{
        $vmail = 1;
    }
    if($city){
        if(Validation::isName($city)){
            $vcity = 1;
        }
        else{//if address not valid
            echo Lang::getLang('validateName');
            Output::checkError('city');
            $vcity = 0;
        }
    }
    else{
        $vcity = 1;
    }
    if($country){
        if(Validation::isName($country)){
            $vcountry = 1;
        }
        else{//if address not valid
            echo Lang::getLang('validateName');
            Output::checkError('country');
            $vcountry = 0;
        }
    }
    else{
        $vcountry = 1;
    }
    if($group){
        if(Validation::isNumeric($group) OR $group == "noGroup"){
            $vgroup = 1;
        }
        else{//if address not valid
            echo Lang::getLang('validateName');
            Output::checkError('group');
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
        echo Lang::getLang('customerExist');
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
            );
            $insert = $dbase->insert($table, $values );
            echo Lang::getLang('proccessSuccess');
            echo Output::cleanInputs();
    }
}
else{
    return false;
}
<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get session

$error = array();

// Get informations
$name = Get::getValue( "name" );
$date = Get::getValue( "date" );
$surname = Get::getValue( "surname" );
$address = Get::getValue( "address" );
$phone = Get::getValue( "phone" );
$mail = Get::getValue( "mail" );
$city = Get::getValue( "city" );
$country = Get::getValue( "country" );
$group = Get::getValue( "group" );

$stepOne = 0;
if(Check::control('name', $name, 'name', true)){
    if(Check::control('name', $surname, 'surname', true)){
        if(Check::control('productName', $address, 'address')){
            if(Check::control('date', $date, 'date', true)){
                if(Check::control('productName', $phone, 'phone')){
                    if(Check::control('mail', $mail, 'mail')){
                        if(Check::control('name', $city, 'city')){
                            if(Check::control('name', $country, 'country')){
                                if($group == "none" OR Check::control('numeric', $group, 'group')){
                                    $checkCustomers = Dbase::isExist('customers', 'customers_name = "'.$name.'" AND customers_surname = "'.$surname.'" ');
                                    if($checkCustomers){
                                        echo Output::addRed('name', 'contentExist');
                                        exit();
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
    }
}


if($stepOne == 1){
    if($group == "none"){$g = NULL;}else{$g = $group;}
    
    $table = 'customers';
    $values = array(
        'customers_name' => $name,
        'customers_surname' => $surname,
        'customers_address' => $address,
        'customers_tel' => $phone,
        'customers_mail' => $mail,
        'customers_country' => $country,
        'customers_city' => $city,
        'customers_group' => $g,
        'customers_addDate' => $date
        );
        $insert = Dbase::insert($table, $values );
        
        Output::refreshDiv('customersList');
}
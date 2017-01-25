<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

//Get posted infs
$name = Get::post("name");
$addDate = Get::post("addDate");
$iban = Get::post("iban");

if(Check::isName($name, "name", true)){
    if(Check::isDate($addDate, "addDate")){
        if($iban == "" OR Check::checkIBAN($iban, "iban")){
            $isProviderExist = $dbase->isExist('cash', 'cash_name = "'.$name.'" ');
            if($isProviderExist != 1){
                $table = 'cash';
                $values = array(
                    'cash_name' => $name,
                    'cash_no' => $iban,
                    'cash_add_date' => $addDate,
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
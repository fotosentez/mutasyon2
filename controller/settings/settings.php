<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions
$where = Get::post('where'); //This for delete row
$id = Get::post('id');
$name = Get::post('name');
$code = Get::post('code');
$addName = Get::post('addName');
$addCode = Get::post('addCode');
$addDoDefault = Get::post('addDoDefault');
$star = Get::post('star');


/*
 * *******************************COMPANY INFS********************************
 */
if($where == "coName"){
    if(Check::isName($name , "coName", true)){
        $updateRow = $dbase->updateOneRow('company', 'company_name = "'.$name.'" ', 'company_id = 1 ');
        echo Lang::getLang('proccessSuccess');
        Output::refreshDiv('#company');
    }
}
if($where == "coAddress"){
    if(Check::isAddress($name , "coAddress")){
        $updateRow = $dbase->updateOneRow('company', 'company_address = "'.$name.'" ', 'company_id = 1 ');
        echo Lang::getLang('proccessSuccess');
        Output::refreshDiv('#company');
    }
}
if($where == "coWeb"){
    if(Check::isUrl($name , "coWeb")){
        $updateRow = $dbase->updateOneRow('company', 'company_web = "'.$name.'" ', 'company_id = 1 ');
        echo Lang::getLang('proccessSuccess');
        Output::refreshDiv('#company');
    }
}
if($where == "coMail"){
    if(Check::isEmail($name , "coMail")){
        $updateRow = $dbase->updateOneRow('company', 'company_mail = "'.$name.'" ', 'company_id = 1 ');
        echo Lang::getLang('proccessSuccess');
        Output::refreshDiv('#company');
    }
}
if($where == "coTel"){
    if(Check::isNumeric($name , "coTel")){
        $updateRow = $dbase->updateOneRow('company', 'company_tel = "'.$name.'" ', 'company_id = 1 ');
        echo Lang::getLang('proccessSuccess');
        Output::refreshDiv('#company');
    }
}

//For add company infs
$coAddress = Get::post('addAddress');
$coWeb = Get::post('addWeb');
$coMail = Get::post('addMail');
$coTel = Get::post('addTel');
if($where == "coIdAdd"){
    if(Check::isName($addName, "addName", true)){
        if(Check::isAddress($coAddress, "addAddress")){
            if(Check::isEmail($coMail, "addMail")){
                if(Check::isNumeric($coTel, "addTel")){
                    if(Check::isUrl($coWeb, "addWeb")){
                        $checkExist = $dbase->isExist('company', 'company_id = 1');
                        if($checkExist == 1){
                            echo Lang::getLang("contentExist");
                            exit();
                        }
                        else{
                            $table = 'company';
                            $values = array(
                                'company_id' => 1,
                                'company_name' => $addName,
                                'company_address' => $coAddress,
                                'company_web' => $coWeb,
                                'company_mail' => $coMail,
                                'company_tel' => $coTel,
                                );
                                $insert = $dbase->insert($table, $values );
                                echo Lang::getLang('proccessSuccess');
                                Output::refreshDiv('#company');
                        }
                    }
                }
            }
        }
    }
}

/*
 * *******************************CURRENCY********************************
*/

//For Add Currency
if($where == "crIdAdd"){
    if($addName AND Check::isName($addName, "addName")){
        if(Check::isName($addCode, "addCode") AND Check::numberOfCharacters($addCode, 3, 3,  "addCode")){
            $newCode = strtoupper($addCode);
            $isExist = $dbase->isExist('currency', 'currency_code = "'.$newCode.'" ');
            if($isExist == 0){
                if($addDoDefault == "on"){
                    $updateBeforeDefault = $dbase->updateOneRow('currency', 'currency_default = 0 ', 'currency_default = 1');
                    $table = 'currency';
                    $values = array(
                        'currency_name' => $addName,
                        'currency_code' => $newCode,
                        'currency_default' => 1,
                        );
                        $insert = $dbase->insert($table, $values );
                        echo Lang::getLang('proccessSuccess');
                        Output::refreshDiv('#currency');
                }
                else{
                    $table = 'currency';
                    $values = array(
                        'currency_name' => $addName,
                        'currency_code' => $newCode,
                        );
                        $insert = $dbase->insert($table, $values );
                        echo Lang::getLang('proccessSuccess');
                        Output::refreshDiv('#currency');
                }
            }
            else{
                echo Lang::getLang("contentExist");
                exit();
            }
        }
    }
}

//For delete currency
if($where == "crIdDelete"){
    if(Check::isNumeric($id, "")){
        $check = $dbase->getRow('currency', 'currency_id = '.$id.' ', 'currency_default');
        if($check == 1){
            echo Lang::getLang("cantDeleteDefault");
            exit();
        }
        else{
            $delete = $dbase->delete('currency', 'currency_id = '.$id.'');
            echo Lang::getLang('proccessSuccess');
            Output::refreshDiv('#currency');
        }
    }
}

//Update for default value
if($where == "crIdUpdate"){
    if(Check::isNumeric($id, "")){
        $check = $dbase->getRow('currency', 'currency_default = 1', 'currency_id');
        if($check){
            $changeDefault = $dbase->updateOneRow('currency', 'currency_default = 0 ', ' currency_id = '.$check.' ');
            $newDefault = $dbase->updateOneRow('currency', 'currency_default = 1 ', ' currency_id = '.$id.' ');
            echo Lang::getLang('proccessSuccess');
            Output::refreshDiv('#currency');
        }
    }
}

//Update values
if($where == "crIdEdit".$id){
    if(Check::isNumeric($id, "")){
        if(Check::isName($name, "name")){
            if(Check::isName($code, "name")){
                if(Check::numberOfCharacters($code, 3, 3,  "code")){
                    $table = 'currency';
                    $values = array(
                        'currency_name' => $name,
                        'currency_code' => $code,
                        );
                        $insert = $dbase->update($table, $values, "currency_id = ".$id." " );
                        echo Lang::getLang('proccessSuccess');
                        Output::refreshDiv('#currency');
                }
            }
        }
    }
}

/*
 * *******************************PREFIX********************************
 */

//Edit the value
if($where === "prIdEdit".$id){
    if(Check::isName($name, 'name', true) AND Check::numberOfCharacters($name, 3, 3,  "name")){
        $edit = $dbase->updateOneRow('prefix', 'prefix_name = "'.$name.'" ', 'prefix_id = '.$id.' ');
        echo Lang::getLang('proccessSuccess');
        Output::refreshDiv('#prefix');
    }
}

//Update for default value
if($where == "prIdUpdate"){
    if(Check::isNumeric($id, "")){
        $check = $dbase->getRow('prefix', 'prefix_default = 1', 'prefix_id');
        if($check){
            $changeDefault = $dbase->updateOneRow('prefix', 'prefix_default = 0 ', ' prefix_id = '.$check.' ');
            $newDefault = $dbase->updateOneRow('prefix', 'prefix_default = 1 ', ' prefix_id = '.$id.' ');
            echo Lang::getLang('proccessSuccess');
            Output::refreshDiv('#prefix');
        }
    }
}

//Delete value
if($where == "prIdDelete"){
    if(Check::isNumeric($id, "")){
        $check = $dbase->getRow('prefix', 'prefix_id = '.$id.' ', 'prefix_default');
        if($check == 1){
            echo Lang::getLang("cantDeleteDefault");
            exit();
        }
        else{
            $delete = $dbase->delete('prefix', 'prefix_id = '.$id.'');
            echo Lang::getLang('proccessSuccess');
            Output::refreshDiv('#prefix');
        }
    }
}
//For Add Currency
if($where == "prIdAdd"){
    if(Check::isName($addName, "addName") AND Check::numberOfCharacters($addName, 3, 3,  "addName")){
        $newName = strtoupper($addName);
        $isExist = $dbase->isExist('prefix', 'prefix_name = "'.$newName.'" ');
        if($isExist == 0){
            if($addDoDefault == "on"){
                $updateBeforeDefault = $dbase->updateOneRow('prefix', 'prefix_default = 0 ', 'prefix_default = 1');
                $table = 'prefix';
                $values = array(
                    'prefix_name' => $newName,
                    'prefix_default' => 1,
                    );
                    $insert = $dbase->insert($table, $values );
                    echo Lang::getLang('proccessSuccess');
                    Output::refreshDiv('#prefix');
            }
            else{
                $table = 'prefix';
                $values = array(
                    'prefix_name' => $newName,
                    );
                    $insert = $dbase->insert($table, $values );
                    echo Lang::getLang('proccessSuccess');
                    Output::refreshDiv('#prefix');
            }
        }
        else{
            echo Lang::getLang("contentExist");
            exit();
        }
    }
}

/*
 * *******************************PAYTYPE********************************
 */

//Edit the value
if($where === "pyIdEdit".$id){
    if(Check::isName($name, 'name', true)){
        $edit = $dbase->updateOneRow('paytype', 'paytype_name = "'.$name.'" ', 'paytype_id = '.$id.' ');
        echo Lang::getLang('proccessSuccess');
        Output::refreshDiv('#paytype');
    }
}

//Delete value
if($where == "pyIdDelete"){
    if(Check::isNumeric($id, "")){
        $delete = $dbase->delete('paytype', 'paytype_id = '.$id.'');
        echo Lang::getLang('proccessSuccess');
        Output::refreshDiv('#paytype');
    }
}
//For Add Currency
if($where == "pyIdAdd"){
    if(Check::isName($addName, "addName")){
        $isExist = $dbase->isExist('paytype', 'paytype_name = "'.$addName.'" ');
        if($isExist == 0){
            $table = 'paytype';
            $values = array(
                'paytype_name' => $addName,
            );
            $insert = $dbase->insert($table, $values );
            echo Lang::getLang('proccessSuccess');
            Output::refreshDiv('#paytype');
        }
        else{
            echo Lang::getLang("contentExist");
            exit();
        }
    }
}

/*
 * *******************************CUSTOMERS GROUP********************************
 */
if($where == "cgIdEdit".$id){
    if(Check::isName($name , "name", true)){
        if(Check::isNumeric($code, "code", true)){
            if(Check::isNumeric($star, "star", true)){
                if(0 < $star AND $star <= 5){
                    $isExist = $dbase->isExist('costumers_groups', 'costumers_groups_name = "'.$name.'" ');
                    if($isExist == 1){
                        echo Lang::getLang("contentExist");
                        exit();
                    }
                    else{
                        $table = 'costumers_groups';
                        $values = array(
                            'costumers_groups_name' => $name,
                            'costumers_groups_discount' => $code,
                            'costumers_groups_star' => $star,
                            );
                            $insert = $dbase->update($table, $values, "costumers_groups_id = ".$id." " );
                            echo Lang::getLang('proccessSuccess');
                            Output::refreshDiv('#customersGroups');
                    }
                }
                else{
                    echo Output::checkError("star", "validateStar");
                    exit();
                }
            }
        }
    }
}

//Delete value
if($where == "cgIdDelete"){
    if(Check::isNumeric($id, "")){
        $delete = $dbase->delete('costumers_groups', 'costumers_groups_id = '.$id.'');
        echo Lang::getLang('proccessSuccess');
        Output::refreshDiv('#customersGroups');
    }
}

//Add group
$addDiscount = Get::post("addDiscount");
$addStar = Get::post("addStar");
if($where == "cgIdAdd"){
    if(Check::isName($addName, "addName", true)){
        if(Check::isNumeric($addDiscount, "addDiscount", true)){
            if(Check::isNumeric($addStar, "addStar", true)){
                if(0 < $addStar AND $addStar <= 5){
                    $isExist = $dbase->isExist('costumers_groups', 'costumers_groups_name = "'.$addName.'" ');
                    if($isExist == 1){
                        echo Lang::getLang("contentExist");
                        exit();
                    }
                    else{
                        $table = 'costumers_groups';
                        $values = array(
                            'costumers_groups_name' => $addName,
                            'costumers_groups_discount' => $addDiscount,
                            'costumers_groups_star' => $addStar,
                            );
                            $insert = $dbase->insert($table, $values);
                            echo Lang::getLang('proccessSuccess');
                            Output::refreshDiv('#customersGroups');
                    }
                }
                else{
                    echo Output::checkError("addStar", "validateStar");
                    exit();
                }
            }
        }
    }
}
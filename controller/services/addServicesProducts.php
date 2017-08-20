<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions

$error = array();

$name = Get::getValue('name');
$desc = Get::getValue('desc');
$sku = Get::getValue('sku');

$stepOne = 0;
if(Check::control('name', $name, 'name', true)){
    if(Check::control('productName', $desc, 'desc')){
        if(Check::numberOfCharacters($sku, 3, 3,  'sku')){
            if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
            else{Output::error();}
        }
    }
}

if($stepOne == 1){
    $isExist = Dbase::isExist('services', 'services_name = "'.$name.'" ');
    if(!$isExist){
        $table = 'services';
        $values = array(
            'services_name' => $name,
            'services__detail' => $desc,
            'services__SKU' => $sku
            );
            $insert = Dbase::insert($table, $values );
            echo Lang::getLang('proccessSuccess');
    }
    else{
        echo Lang::getLang('contentExist');
        exit();
    }
}

?>
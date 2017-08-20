<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions

$error = array();

$type = Get::getValue("type");
$name = Get::getValue("name");
$desc = Get::getValue("desc");
$sku = Get::getValue("sku");
$main = Get::getValue("main");


$stepOne = 0;
if(Check::control('name', $name, 'name', true)){
    if(Check::control('productName', $desc, 'desc')){
        if($type == "sub"){
            if(Check::control('numeric', $main, 'main', true)){
                if(Check::numberOfCharacters($sku, 3, 3,  'sku')){
                    if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
                    else{Output::error();}
                }
            }
        }
        else{
            if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
            else{Output::error();}
        }
    }
}

if($stepOne == 1){
    
    //---------------------CHECK EXIST------------------------------------------------------------------------------
    if($type == "main"){
        $checkExist = Dbase::isExist('maincategory', 'maincategory_name = "'.$name.'" ');
    }
    else if($type == "sub"){
        $checkExist = Dbase::isExist('subcategory', 'subcategory_name = "'.$name.'" AND subcategory_main = '.$main);
    }
    
    if($checkExist){
        echo Lang::getLang('contentExist');
        exit();
    }
    //--------------------------------------------------------------------------------------------------------------
    
    if($type == "main"){
        $table = 'maincategory';
        $values = array(
            'maincategory_name' => $name,
            'maincategory_desc' => $desc,
            );
            
            $insert = Dbase::insert($table, $values );     
            echo Lang::getLang('proccessSuccess');
    }
    else if($type == "sub"){
        $table = 'subcategory';
        $values = array(
            'subcategory_name' => $name,
            'subcategory_desc' => $desc,
            'subcategory_prefix' => $sku,
            'subcategory_main' => $main,
            );
            
            $insert = Dbase::insert($table, $values );     
            echo Lang::getLang('proccessSuccess');
    }
}

?>
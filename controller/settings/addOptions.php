<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
$error = array();

$name = Get::getValue('name');
$sku = Get::getValue('sku');
$main = Get::getValue('main');
$type = Get::getValue('type');


$stepOne = 0;
if(Check::control('desc', $name, 'name', true)){
    if($type == "sub"){
        if(Check::numberOfCharacters($sku, 3, 3,  'sku')){
            if(Check::control('numeric', $main, 'main', true)){
                if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
                else{Output::error();}
            }
        }
    }
    else if($type == "main"){
        if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
        else{Output::error();}
    }
    else{
        exit();
    }
}

if($stepOne == 1){
    //------IF GROUP-----------------------------------------------------------
    if($type == "main"){
        $checkExist = Dbase::isExist('optionsGroup', 'og_name = "'.$name.'" ');
        if($checkExist){
            echo Lang::getLang('contentExist');
            exit();
        }
        else{
            $table = 'optionsGroup';
            $values = array(
                'og_name' => $name,
                ); 
        } 
    }
    
    //-----IF OPTIONS------------------------------------------------------------
    else if($type == "sub"){
        $checkExist = Dbase::isExist('options', 'options_name = "'.$name.'" OR options_sku = "'.$sku.'" ');
        if($checkExist){
            echo Lang::getLang('contentExist');
            exit();
        }
        else{
            $table = 'options';
            $values = array(
                'options_sku' => $sku,
                'options_name' => $name,
                'options_optionsGroup_id' => $main,
                );
        }
    }
    else{
        exit();
    }
    
    
    $insert = Dbase::insert($table, $values );
    echo Lang::getLang('proccessSuccess').'<script type="text/javascript">setTimeout(location.reload.bind(location), 2000);</script>';
}

?>

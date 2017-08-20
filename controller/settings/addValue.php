<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions
$error = array();

$value = Get::getValue('value');
$attributes = Get::getValue('attributes');
$what = Get::getValue('what');
$id = Get::getValue('id');

$stepOne = 0;
$stepAdd = 0;
$stepDDU = 0;
if($what=='brand' OR $what=='amountType' OR $what=='language' OR $what=='currency' OR $what=='prefix' OR $what=='payType' OR $what=='cash' OR $what=='customersGroups' OR $what=='colors' OR $what=='themes' OR $what=='delete' OR $what=='default' OR $what=='update' OR $what=='none'){
    if(Check::control('equal', $what.',none', 'what', true)){
        if($what == 'customersGroups'){
            if(Check::control('numeric', $attributes, 'attributes', true)){
                if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
                else{Output::error();}
            }
        }
        else{
            if($what == 'amountType' OR $what == 'language' OR $what == 'currency' OR $what == 'colors'){
                if(Check::control('name', $attributes, 'attributes', true)){
                    if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
                    else{Output::error();}
                }
            }
            else{
                if(Check::control('name', $attributes, 'attributes')){
                    if(empty($error)){$stepOne = 1; echo Lang::getLang('checkSuccess')."<br />";}
                    else{Output::error();}
                }
            }
        }
    }
}



if($stepOne == 1){
    
    if($what == "themes"){
        $path = _BASEDIR_.'/view/'.$value.'/header.html';
        if(file_exists($path)){$stepAdd = 1;}
        else{echo "Öncelikle tema dosyalarını sunucuya yükleyiniz!";exit();}
    }
    else if($what=='delete' OR $what=='default' OR $id){
        $stepDDU = 1;
    }
    else{
        $stepAdd = 1;
    }
}

if($stepAdd == 1){
    if($what == 'brand' OR $what == 'amountType' OR $what == 'language' OR $what == 'currency' OR $what == 'prefix' OR $what == 'payType' OR $what == 'cash' OR $what == 'customersGroups' OR $what == 'colors' OR $what == 'themes'){
        
        //----------------CHECK NAME OR VALUE--------------------------------------------------------
        if($what == 'amountType' OR $what == 'language' OR $what == 'currency' OR $what == 'colors'){
            $checkExist = Dbase::isExist('settings', 's_attributes = "'.$attributes.'" OR s_value = "'.$value.'" ');
        }
        else{
            $checkExist = Dbase::isExist('settings', 's_value = "'.$value.'"');
        }
        //-------------------------------------------------------------------------------------------
        
        if($what == 'brand' OR $what == 'amountType' OR $what == 'colors'){$group = "products";}
        if($what == 'language' OR $what == 'currency' OR $what == 'themes'){$group = "configs";}
        if($what == 'prefix' OR $what == 'payType' OR $what == 'cash'){$group = "invoice";}
        if($what == 'customersGroups'){$group = "customers";}
        
        
        if($checkExist){
            echo Lang::getLang('contentExist');
            exit();
        }
        else{
            $checkDefault = Dbase::isExist('settings', 's_name = "'.$what.'" AND s_default = 1');
            if($checkDefault){$default = 0;}else{$default = 1;}
            
            $table = 'settings';
            $values = array(
                's_name' => $what,
                's_value' => $value,
                's_attributes' => $attributes,
                's_default' => $default,
                's_group' => $group,
                );
                $insert = Dbase::insert($table, $values );
                echo Lang::getLang('proccessSuccess');
                Output::refreshDiv($what);
        }
        
    }
}



//-------------------UPDATE DEFAULT OR DELETE SETTING VALUE------------------------------------------
if($stepDDU == 1){
    if($what == 'default'){
        if(Check::control('numeric', $id, '', true)){
            $getDefaultId = Dbase::getRow('settings', 's_name = (SELECT s_name FROM settings WHERE s_id = '.$id.') AND s_default = 1', 's_id');
            if($id != $getDefaultId){
                $updateDefault = Dbase::updateOneRow('settings', 's_default = 1', 's_id = '.$id);
                $changeDefault = Dbase::updateOneRow('settings', 's_default = 0', 's_id = '.$getDefaultId);
            }
        }
    }
    else if($what == "delete"){
        if(Check::control('numeric', $id, '', true)){
            $isDefault = Dbase::getRow('settings', 's_id = '.$id, 's_default');
            if($isDefault != 1){
                $delete = Dbase::delete('settings', 's_id = '.$id);
            }
            else{
                echo Lang::getLang('cantDeleteDefault');
                exit();
            }
        }
    }
    else{
        if(Check::control('numeric', $id, '', true)){
            $table = 'settings';
            $values = array(
                's_value' => $value,
                's_attributes' => $attributes,
                );
                $insert = Dbase::update($table, $values, 's_id = '.$id );
        }
    }
    
    echo '<script type="text/javascript">setTimeout(function(){location.reload();}, 1000); </script>'.Lang::getLang("proccessSuccess");
}

?>
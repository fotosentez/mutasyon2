<?php
require_once(dirname(__FILE__).'/../../model/settings/include.php'); // Get All Functions

$options = Get::getValue('options');
$colors = Get::getValue('colors');
$productID = Get::getValue('productID');

if(Check::control('numeric', $productID, 'productID', true)){
    
   
    //Only options
    if($colors == "none" AND $options != "none"){
        if(Check::control('numeric', $options, 'options')){
            
            $prefix = Dbase::getRow('options', 'options_id = '.$options, 'options_sku');
            
            $checkoptions = Dbase::isExist('products_options', 'po_products_id = '.$productID.' AND po_options_id = '.$options.' AND po_colors_id IS NULL ');
            
            if(!$checkoptions){
                $table = 'products_options';
                $values = array(
                    'po_products_id' => $productID,
                    'po_sku' => $prefix,
                    'po_colors_id' => NULL,
                    'po_options_id' => $options,
                    );
                    
                    $insert = Dbase::insert($table, $values );     
                    echo Lang::getLang('proccessSuccess');
            }
            else{
                echo Lang::getLang('contentExist');
                exit();
            }
        }
    }
    
    
    
    //Only Colors
    else if($options == "none" AND $colors != "none"){
        
        $prefix = Dbase::getRow('settings', 's_name = "colors" AND s_id = '.$colors, 's_attributes');
        
        $checkoptions = Dbase::isExist('products_options', 'po_products_id = '.$productID.' AND po_options_id = "" AND po_colors_id = '.$colors.' ');
        
        if(!$checkoptions){
            $table = 'products_options';
            $values = array(
                'po_products_id' => $productID,
                'po_sku' => $prefix,
                'po_colors_id' => $colors,
                'po_options_id' => NULL,
                );
                
                $insert = Dbase::insert($table, $values );     
                echo Lang::getLang('proccessSuccess');
        }
        else{
            echo Lang::getLang('contentExist');
            exit();
        }
    }
    
    
    
    //Colors and Contents
    else if($options != "none" AND $colors != "none"){
        if(Check::control('numeric', $colors, 'colors')){
            if(Check::control('numeric', $options, 'options')){
                
                $colorsPrefix = Dbase::getRow('settings', 's_name = "colors" AND s_id = '.$colors, 's_attributes');
                $optionsPrefix = Dbase::getRow('options', 'options_id = '.$options, 'options_sku');
                $prefix =  $colorsPrefix.$optionsPrefix;
                
                $checkoptions = Dbase::isExist('products_options', 'po_products_id = '.$productID.' AND po_options_id = '.$options.' AND po_colors_id = '.$colors.' ');
                
                if(!$checkoptions){
                    $table = 'products_options';
                    $values = array(
                        'po_products_id' => $productID,
                        'po_sku' => $prefix,
                        'po_colors_id' => $colors,
                        'po_options_id' => $options,
                        );
                        
                        $insert = Dbase::insert($table, $values );     
                        echo Lang::getLang('proccessSuccess');
                }
                else{
                    echo Lang::getLang('contentExist');
                    exit();
                }
                
            }
        }
    }
    
    //If not anything posted
    else{
        exit();
    }

 }

?>
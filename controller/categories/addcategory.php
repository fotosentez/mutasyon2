<?php
require_once(dirname(__FILE__).'/../../model/settings/settings.php'); // Get All Functions

//get infs
$categoryType = Get::post("categoryType");
$name = Get::post("name");
$desc = Get::post("desc");
$prefix = Get::post("prefix");
$category = Get::post("category");
$modal = Get::post("modal"); //This for refresh div

if(Check::isName($name, "name", true)){
    if(Check::isName($desc, "desc") OR $desc == ""){
        if($categoryType == "mainCategory"){
            //Check for this category exist!
            $isCategoryExist = $dbase->isExist('maincategory', 'maincategory_name =  "'.$name.'" ');
            if($isCategoryExist == 0){
                $table = 'maincategory';
                $values = array(
                    'maincategory_name' => $name,
                    'maincategory_desc' => $desc,
                    );
                    $insert = $dbase->insert($table, $values );
                    if($modal == "modal"){
                        Output::refreshDiv('.categorylist');
                    }
                    else{
                        Output::cleanAllInputs();
                    }
                    echo Lang::getLang("proccessSuccess");
            }
            else{
                echo Lang::getLang("contentExist");
                exit();
            }
        }
        else if($categoryType == "subCategory"){
            if(Check::isName($prefix, "prefix") AND Check::numberOfCharacters($prefix, "3", "3", "prefix")){
                if(Check::isNumeric($category, "category") AND $category != ""){
                    //Check for this category exist!
                    $isCategoryExist = $dbase->isExist('subcategory', 'subcategory_name =  "'.$name.'" AND subcategory_main = '.$category.' ');
                    if($isCategoryExist == 0){
                        $table = 'subcategory';
                        $values = array(
                            'subcategory_name' => $name,
                            'subcategory_desc' => $desc,
                            'subcategory_prefix' => $prefix,
                            'subcategory_main' => $category,
                            );
                            $insert = $dbase->insert($table, $values );
                            if($modal == "modal"){
                                Output::refreshDiv('.categorylist');
                            }
                            else{
                                Output::cleanAllInputs();
                            }
                            echo Lang::getLang("proccessSuccess");
                    }
                    else{
                        echo Lang::getLang("contentExist");
                        exit();
                    }
                }
            }
        }
        else{
            echo Lang::getLang("errorChangeValue");
            exit();
        }
    }
}




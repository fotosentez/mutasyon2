<?php

$language = Dbase::getRow('settings', 's_name = "language" AND s_default = 1 ', 's_value');

if($language){
    $langExist = dirname(__FILE__).'/../../model/langs/'.Settings::getRow('language', 'default').'.php';
    
    /*--------------------IF LOGIN--------------------------------------------------------------
     */
    if(isset($_SESSION["mutasyon_login"])){
        $userLangExist = dirname(__FILE__).'/../../model/langs/'.Superuser::getRow("lang").'.php';
        if(file_exists($userLangExist)){require_once(dirname(__FILE__).'/../../model/langs/'.Superuser::getRow("lang").'.php');}
        else if(file_exists($langExist)){require_once(dirname(__FILE__).'/../../model/langs/'.Settings::getRow('language', 'default').'.php');}
        else{require_once(dirname(__FILE__).'/../../model/langs/tr.php');}
    }
    //--------------------------------------------------------------------------------------------
    
    
    /*------------------------------IF NOT LOGIN--------------------------------------------------
     */
    else if(file_exists($langExist)){require_once(dirname(__FILE__).'/../../model/langs/'.Settings::getRow('language', 'default').'.php');}
    else{require_once(dirname(__FILE__).'/../../model/langs/tr.php');}
    //---------------------------------------------------------------------------------------------
}
else{
    require_once(dirname(__FILE__).'/../../model/langs/tr.php');
}


?>
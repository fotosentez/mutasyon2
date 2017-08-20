<?php

$template = Dbase::getRow('settings', 's_name = "themes" AND s_default = 1 ', 's_value');

if($template){
    $tempExist = _BASEDIR_.'/view/'.$template.'/header.html';
    
    if(file_exists($tempExist)){
        define('_THEME_BASE_DIR_', _BASEDIR_.'/view/'.Settings::getRow('themes', 'default').'/');
    }
    else{
        define('_THEME_BASE_DIR_', _BASEDIR_.'/view/default/');
    }
}
else{
    define('_THEME_BASE_DIR_', _BASEDIR_.'/view/default/');
}


?>
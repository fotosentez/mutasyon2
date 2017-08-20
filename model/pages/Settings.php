<?php

Class Settings{
    
    function getRow($what = "", $options = ''){
        
        /*----------------------------------------------------------------------------------------
         * E.g. Settings::getRow('prefix');
         */
        if($what AND !$options){
            $settings =  Dbase::getRows('*', 'settings', 's_name = "'.$what.'" ');
        }
        //-----------------------------------------------------------------------------------------
        
        
        /*----------------------------------------------------------------------------------------
         * E.g. Settings::getRow('prefix', 'default');
         * For get default row for wharever you want
         */ 
        else if($what AND $options = 'default'){
            $settings = Dbase::getRow('settings', 's_name = "'.$what.'" AND s_default = 1 ', 's_attributes');
        }
        //----------------------------------------------------------------------------------------
        
        
        
        /*----------------------------------------------------------------------------------------
         * E.g. Settings::getRow('', 'group');
         * For foreach all rows in table by group name
         */
        else if($options == 'group'){
            $settings = Dbase::getRows('s_group', 'settings', 's_group <> 0 GROUP BY s_group');
        }
        //----------------------------------------------------------------------------------------
        
        
        
        /*----------------------------------------------------------------------------------------
         * E.g. Settings::getRow();
         * For foreach all rows in settings table
         */
        else if($options == 'products' OR $options == 'invoice' OR $options == 'configs' OR $options == 'customers'){
            $settings = Dbase::getRows('s_name', 'settings', 's_name <> "0" AND s_group = "'.$options.'" GROUP BY s_name ');
        }
        //----------------------------------------------------------------------------------------
        
        
        return $settings;
    }
    
    
    //Build page
    function build(){
        Page::build("settings/settings", Lang::getLang("settings"));
    }
}

?>
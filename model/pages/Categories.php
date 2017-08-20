<?php
Class Categories{
    
    function getRow($what = "", $gid = ""){
        
        ($gid ? $id = $gid : $id = Get::getValue('id'));
        
        if($what == "main"){
            return Dbase::getRows('*', 'maincategory', 'maincategory_id <> 0 ');
        }
        else if($what == "sub"){
            return Dbase::getRows('*', 'subcategory', 'subcategory_id <> 0');
        }
        else{
            return Dbase::getRow('subcategory INNER JOIN maincategory ON maincategory_id = subcategory_main', 'subcategory_id = '.$id.' ', $what);
        }
    }
    
    
}

?>
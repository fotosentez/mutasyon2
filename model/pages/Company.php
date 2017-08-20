<?php
Class Company{
    
    function getRow($what = ""){
        
        return Dbase::getRow('company', 'company_default = 1', $what);
        
    }
    
    
}

?>